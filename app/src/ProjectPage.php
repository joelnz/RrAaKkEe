<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Forms\TextareaField;

    class ProjectPage extends SiteTree
    {
        private static $singular_name = 'Project Page';

        private static $description = 'An individual cat project with images';

        private static $db = [
            'Description' => 'Text',
        ];

        private static $many_many = [
            'Images' => Image::class,
        ];

        private static $many_many_extraFields = [
            'Images' => [
                'SortOrder' => 'Int',
            ],
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $fields->addFieldToTab('Root.Main', TextareaField::create('Description', 'Project Description'));

            $images = UploadField::create('Images', 'Project Images');
            $images->setFolderName('projects');
            $fields->addFieldToTab('Root.Images', $images);

            return $fields;
        }
    }
}
