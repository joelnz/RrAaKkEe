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
    }
}
