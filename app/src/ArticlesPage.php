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

        /** Next 2 for section2 text drawers column 3 */
        public function getSectionDrawersCol3()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            return $this->getArticles()->exclude('ID', $exclude)->limit(2, 2);
        }

        /** Next 2 for section2 text drawers column 4 */
        public function getSectionDrawersCol4()
        {
            $exclude = [];
            if ($f = $this->getSectionFeatured()) $exclude[] = $f->ID;
            if ($s = $this->getSectionSecondary()) $exclude[] = $s->ID;
            return $this->getArticles()->exclude('ID', $exclude)->limit(2, 4);
        }
    }
}
