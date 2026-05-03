<?php

namespace App\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Input\InputInterface;
use ArticlePage;

class PrefillAuthorTask extends BuildTask
{
    private static string $segment = 'prefill-authors';

    protected string $title = 'Prefill Article Authors';
    protected static string $description = 'Sets Author to Anonymous Ghost for all articles.';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $articles = ArticlePage::get()->filter('Author', ['', null]);
        $count = $articles->count();
        $output->writeln("Found $count articles without an author.");

        $updated = 0;
        foreach ($articles as $article) {
            $article->Author = 'Anonymous Ghost';
            $article->write();
            if ($article->isPublished()) {
                $article->publishRecursive();
            }
            $updated++;
        }

        $output->writeln("Done! $updated articles updated to Anonymous Ghost.");
        return 0;
    }
}
