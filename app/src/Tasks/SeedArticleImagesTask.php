<?php

namespace App\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\Folder;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Input\InputInterface;
use ArticlePage;

class SeedArticleImagesTask extends BuildTask
{
    private static string $segment = 'seed-article-images';

    protected string $title = 'Seed Article Images';
    protected static string $description = 'Assigns random images from temp/images/ to articles that have no FeaturedImage.';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $sourceDir = BASE_PATH . '/temp/images';

        if (!is_dir($sourceDir)) {
            $output->writeln("ERROR: $sourceDir not found.");
            return 1;
        }

        // Gather all image files
        $files = [];
        foreach (scandir($sourceDir) as $f) {
            if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $files[] = $f;
            }
        }

        if (empty($files)) {
            $output->writeln("ERROR: No image files found in $sourceDir");
            return 1;
        }

        $output->writeln(count($files) . " source images found.");

        // Get or create the upload folder
        $folder = Folder::find_or_make('article-seeds');

        // Find articles without a FeaturedImage
        $articles = ArticlePage::get()->filter('FeaturedImageID', 0);
        $count = $articles->count();
        $output->writeln("$count articles without FeaturedImage.");

        foreach ($articles as $article) {
            // Pick a random image
            $filename = $files[array_rand($files)];
            $sourcePath = $sourceDir . '/' . $filename;

            // Check if we already uploaded this file (reuse it)
            $existing = Image::get()->filter('Name', $filename)->first();

            if ($existing) {
                $image = $existing;
            } else {
                // Create a new Image record and publish it
                $image = Image::create();
                $image->setFromLocalFile($sourcePath, 'article-seeds/' . $filename);
                $image->ParentID = $folder->ID;
                $image->write();
                $image->publishSingle();
            }

            $article->FeaturedImageID = $image->ID;
            $article->write();
            $article->publishRecursive();

            $output->writeln("  ✓ {$article->Title} → {$filename}");
        }

        $output->writeln("Done! $count articles updated.");
        return 0;
    }
}
