<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;

    class ProjectsPage extends SiteTree
    {
        private static $singular_name = 'Projects Page';

        private static $description = 'Lists all cat projects';

        private static $allowed_children = [ProjectPage::class];

        public function getProjects()
        {
            return ProjectPage::get()->filter('ParentID', $this->ID);
        }
    }
}
