<?php

namespace {

    use SilverStripe\Control\Controller;
    use SilverStripe\Control\HTTPRequest;
    use SilverStripe\Control\HTTPResponse;
    use SilverStripe\Security\Permission;
    use SilverStripe\Security\SecurityToken;

    class ArticleGeneratorController extends Controller
    {
        private static $allowed_actions = ['generate', 'seed'];
        private static $url_handlers    = [
            'generate' => 'generate',
            'seed'     => 'seed'
        ];

        public function seed(HTTPRequest $request): HTTPResponse
        {
            $response = HTTPResponse::create();
            $response->addHeader('Content-Type', 'application/json');

            if (!Permission::check('CMS_ACCESS_CMSMain')) {
                $response->setStatusCode(403);
                $response->setBody(json_encode(['error' => 'Not authorised']));
                return $response;
            }

            $text = $request->postVar('text');
            if (!$text || strlen(trim($text)) < 100) {
                // Try to fallback to some default text if not provided
                $text = "The quick brown fox jumps over the lazy dog. A digital collage experiment that blends language, probability, and imagery. I started this project in 2015 as an exploration of collected content. The name comes from the garden tool—raking together fallen leaves, fragments of news, books, and essays into one place. The heart of the project is a text generator that I built to analyze writing samples and generate new articles based on word probability. I paired these generated texts with my own photography from Flickr to see what kind of poetic titles and weird image juxtapositions would come up. It is an experiment in how machine logic can create new meaning through collage.";
            }

            $chain = $this->buildChain($text);
            if (count($chain['_START']) < 5) {
                $response->setStatusCode(400);
                $response->setBody(json_encode(['error' => 'Not enough unique words']));
                return $response;
            }

            // Increase limits for large batches
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            $sections = ArticlesPage::get();
            $created = 0;

            foreach ($sections as $section) {
                for ($i = 0; $i < 24; $i++) {
                    $content = $this->generateArticle($chain);
                    if (!$content) continue;

                    $article = ArticlePage::create();
                    $article->ParentID = $section->ID;
                    $article->Title   = substr($content['title'], 0, 200);
                    $article->Excerpt = $content['excerpt'];
                    $article->Content = $content['body'];
                    $article->FeaturedImageCaption = substr($content['caption'], 0, 200);
                    $article->Category = $section->Title;

                    // Assign random image
                    $randomImg = \SilverStripe\Assets\Image::get()->sort('RAND()')->first();
                    if ($randomImg) {
                        $article->FeaturedImageID = $randomImg->ID;
                    }

                    $article->write();
                    $article->copyVersionToStage('Stage', 'Live');
                    $created++;
                }
            }

            $response->setBody(json_encode([
                'success' => true,
                'created' => $created,
                'sections' => $sections->count()
            ]));
            return $response;
        }

        public function generate(HTTPRequest $request): HTTPResponse
        {
            $response = HTTPResponse::create();
            $response->addHeader('Content-Type', 'application/json');

            if (!Permission::check('CMS_ACCESS_CMSMain')) {
                $response->setStatusCode(403);
                $response->setBody(json_encode(['error' => 'Not authorised']));
                return $response;
            }

            if (!$request->isPOST()) {
                $response->setStatusCode(405);
                $response->setBody(json_encode(['error' => 'POST only']));
                return $response;
            }

            $text = $request->postVar('text');
            if (!$text || strlen(trim($text)) < 100) {
                $response->setStatusCode(400);
                $response->setBody(json_encode(['error' => 'Need at least 100 characters of source text']));
                return $response;
            }

            $chain = $this->buildChain($text);

            if (count($chain['_START']) < 5) {
                $response->setStatusCode(400);
                $response->setBody(json_encode(['error' => 'Not enough unique words — paste more text']));
                return $response;
            }

            // Increase limits for large batches
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            $articles = ArticlePage::get();
            $updated  = 0;

            foreach ($articles as $article) {
                $content = $this->generateArticle($chain);
                if (!$content) continue;

                $article->Title   = substr($content['title'], 0, 200);
                $article->Excerpt = $content['excerpt'];
                $article->Content = $content['body'];
                $article->FeaturedImageCaption = substr($content['caption'], 0, 200);
                
                // Assign random image if not already set
                if (!$article->FeaturedImageID) {
                    $randomImg = \SilverStripe\Assets\Image::get()->sort('RAND()')->first();
                    if ($randomImg) {
                        $article->FeaturedImageID = $randomImg->ID;
                    }
                }

                $article->write();
                $updated++;
            }

            $response->setBody(json_encode([
                'success' => true,
                'updated' => $updated,
            ]));
            return $response;
        }

        // ----------------------------------------------------------------
        // Markov chain
        // ----------------------------------------------------------------

        private function buildChain(string $text): array
        {
            $words = preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY);
            $chain = ['_START' => []];

            if (empty($words)) return $chain;

            $chain['_START'][] = $words[0];

            for ($i = 0; $i < count($words) - 1; $i++) {
                $w = $words[$i];
                if (!isset($chain[$w])) $chain[$w] = [];
                $chain[$w][] = $words[$i + 1];
                if (preg_match('/[.!?]$/', $w)) {
                    $chain['_START'][] = $words[$i + 1];
                }
            }

            return $chain;
        }

        private function generateRaw(array $chain, int $wordCount): string
        {
            if (empty($chain['_START'])) return '';

            $cur = '_START';
            $str = '';

            for ($i = 0; $i < $wordCount; $i++) {
                $pool = $chain[$cur];
                if (empty($pool)) break;
                $w    = $pool[array_rand($pool)];
                $str .= $w;
                if (!isset($chain[$w])) {
                    $cur  = '_START';
                    $str .= '. ';
                } else {
                    $cur  = $w;
                    $str .= ' ';
                }
            }

            return $str;
        }

        private function generateArticle(array $chain): ?array
        {
            $raw = $this->generateRaw($chain, 400);
            preg_match_all('/[^.!?]+[.!?]+/', $raw, $m);
            $sents = array_map('trim', $m[0]);

            if (count($sents) < 8) return null;

            // Title: first sentence between 20–90 chars
            $title = '';
            for ($i = 2; $i < count($sents); $i++) {
                if (strlen($sents[$i]) > 20 && strlen($sents[$i]) < 90) {
                    $title = $sents[$i];
                    break;
                }
            }
            if (!$title) $title = $sents[3];

            // Excerpt: 1 sentence
            $excerpt = $sents[0];

            // Caption: 1 sentence
            $caption = isset($sents[1]) ? $sents[1] : $sents[0];

            // Body: 4 paragraphs × 3 sentences
            $body  = '';
            $start = 4;
            for ($j = 0; $j < 4; $j++) {
                $para = '';
                for ($k = 0; $k < 3; $k++) {
                    $idx = $start + $j * 3 + $k;
                    if (isset($sents[$idx])) $para .= $sents[$idx] . ' ';
                }
                $para = trim($para);
                if ($para) $body .= "<p>{$para}</p>\n";
            }

            return ['title' => $title, 'excerpt' => $excerpt, 'caption' => $caption, 'body' => $body];
        }
    }
}
