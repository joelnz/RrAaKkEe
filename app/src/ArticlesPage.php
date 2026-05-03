<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;

    class ArticlesPage extends SiteTree
    {
        private static $singular_name = 'Articles Section';
        private static $description = 'A section listing articles';
        private static $allowed_children = [ArticlePage::class];

        public function getArticles()
        {
            return ArticlePage::get()->filter('ParentID', $this->ID)->sort('Created DESC');
        }

        /** Featured article for section1 (most recent) */
        public function getSectionFeatured()
        {
            return $this->getArticles()->first();
        }

        /** Secondary article for section1 top-art (2nd most recent) */
        public function getSectionSecondary()
        {
            $featured = $this->getSectionFeatured();
            if (!$featured) return null;
            return $this->getArticles()->exclude('ID', $featured->ID)->first();
        }

        /** First 2 articles for section2 image cards (excluding featured+secondary) */
        public function getSectionImageCards()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            return $this->getArticles()->exclude('ID', $exclude)->limit(2, 0);
        }

        /** Next 3 for section2 text drawers column 3 */
        public function getSectionDrawersCol3()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            return $this->getArticles()->exclude('ID', $exclude)->limit(3, 2);
        }

        /** Next 3 for section2 text drawers column 4 */
        public function getSectionDrawersCol4()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            return $this->getArticles()->exclude('ID', $exclude)->limit(3, 5);
        }

        /** 
         * Grouped overflow articles after the first 10.
         * Returns an ArrayList of groups, each containing 8 articles and a layout type.
         */
        public function getGroupedOverflow()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            if ($cards = $this->getSectionImageCards()) foreach($cards as $c) $exclude[] = $c->ID;
            if ($d3 = $this->getSectionDrawersCol3()) foreach($d3 as $d) $exclude[] = $d->ID;
            if ($d4 = $this->getSectionDrawersCol4()) foreach($d4 as $d) $exclude[] = $d->ID;

            $remaining = $this->getArticles()->exclude('ID', $exclude);
            $list = \SilverStripe\Model\List\ArrayList::create();
            
            $count = 0;
            $currentGroup = \SilverStripe\Model\List\ArrayList::create();
            $layoutIndex = 1; // 1 = Reversed, 2 = Normal

            foreach ($remaining as $article) {
                $currentGroup->push($article);
                $count++;

                if ($count == 8) {
                    $list->push(\SilverStripe\Model\ArrayData::create([
                        'Articles' => $currentGroup,
                        'IsReversed' => ($layoutIndex % 2 !== 0)
                    ]));
                    $currentGroup = \SilverStripe\Model\List\ArrayList::create();
                    $count = 0;
                    $layoutIndex++;
                }
            }

            // Push remaining if any (less than 4)
            if ($currentGroup->count() > 0) {
                $list->push(\SilverStripe\Model\ArrayData::create([
                    'Articles' => $currentGroup,
                    'IsReversed' => ($layoutIndex % 2 !== 0)
                ]));
            }

            return $list;
        }
    }
}
