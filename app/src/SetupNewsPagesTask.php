<?php

namespace {

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use SilverStripe\CMS\Model\SiteTree;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class SetupNewsPagesTask extends BuildTask
{
    protected string $title = 'Setup Rake News Pages';
    protected static string $description = 'Creates Fashion, Film, Music, Books, Politics sections with sample articles';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        // Archive old non-news pages
        $toArchive = ['About Us', 'About Me', 'About', 'Projects', 'Contact Us', 'Contact', 'Contact Me'];
        foreach ($toArchive as $title) {
            $page = SiteTree::get()->filter('Title', $title)->first();
            if ($page) {
                $page->doArchive();
                $output->writeln("Archived: $title");
            }
        }

        $sections = [
            'Fashion' => [
                ['Title' => 'The return of the oversized blazer', 'Excerpt' => 'After years of slim silhouettes, tailoring is going big again — and this time it means business.', 'Author' => 'Clara Moss'],
                ['Title' => 'Inside the atelier: how pattern cutters work', 'Excerpt' => 'We spent a week with the craftspeople who turn a designer\'s sketch into wearable reality.', 'Author' => 'James Lowe'],
                ['Title' => 'Why vintage denim will never go out of style', 'Excerpt' => 'The denim market is a strange beast. Every decade it reinvents itself while staying exactly the same.', 'Author' => 'Clara Moss'],
                ['Title' => 'The quiet revolution in menswear', 'Excerpt' => 'A generation of designers is rethinking what men\'s clothes are for — and it has nothing to do with suits.', 'Author' => 'James Lowe'],
                ['Title' => 'Colour blocking: the case for going too far', 'Excerpt' => 'The most interesting dressers aren\'t the ones who get it right. They\'re the ones who commit completely.', 'Author' => 'Nina Hart'],
                ['Title' => 'What fashion week stopped being about', 'Excerpt' => 'The shows still happen twice a year. What they\'re actually for is the question nobody answers honestly.', 'Author' => 'Clara Moss'],
                ['Title' => 'The shoe as object', 'Excerpt' => 'Footwear has always sat between function and sculpture. A new wave of designers is pushing it further into art.', 'Author' => 'Nina Hart'],
                ['Title' => 'Archive fever: why everyone is shopping old collections', 'Excerpt' => 'Vintage fashion has stopped being niche. Understanding why tells you something uncomfortable about newness.', 'Author' => 'James Lowe'],
                ['Title' => 'The fabric matters more than the cut', 'Excerpt' => 'Most people buy clothes without touching them first. The designers who know better are making something different.', 'Author' => 'Nina Hart'],
                ['Title' => 'Dressing for a city that no longer exists', 'Excerpt' => 'Urban style has always lagged behind urban life. Right now, the gap feels bigger than ever.', 'Author' => 'Clara Moss'],
            ],
            'Film' => [
                ['Title' => 'The slow cinema of Apichatpong Weerasethakul', 'Excerpt' => 'Time, memory, and ghosts: a look at the Thai director whose films operate on a frequency all their own.', 'Author' => 'Otto Braun'],
                ['Title' => 'Criterion at 40: how a distributor became a canon', 'Excerpt' => 'The Collection started as a laser disc label. It ended up defining what we think film history is.', 'Author' => 'Rosa Field'],
                ['Title' => 'Against the three-act structure', 'Excerpt' => 'Screenwriting gurus have sold us a formula. The best films of the last decade largely ignore it.', 'Author' => 'Otto Braun'],
                ['Title' => 'The cinematographer\'s eye', 'Excerpt' => 'We talk endlessly about directors. The person who decides what a shot actually looks like rarely gets named.', 'Author' => 'Rosa Field'],
                ['Title' => 'Why horror is the most honest genre', 'Excerpt' => 'Other genres pretend to tell the truth. Horror admits upfront that it\'s going to scare you — and does it anyway.', 'Author' => 'Leo Vance'],
                ['Title' => 'The long take and the patience it requires', 'Excerpt' => 'Watching a six-minute uncut shot is an act of surrender. That\'s exactly the point.', 'Author' => 'Otto Braun'],
                ['Title' => 'Documentary as portrait', 'Excerpt' => 'The best non-fiction films aren\'t about their subjects. They\'re about the relationship between subject and camera.', 'Author' => 'Leo Vance'],
                ['Title' => 'Score or silence: the music beneath the image', 'Excerpt' => 'Some directors score everything. Others trust the room tone. Both choices are arguments about what film is for.', 'Author' => 'Rosa Field'],
                ['Title' => 'The DVD era and what we lost when it ended', 'Excerpt' => 'Special features, audio commentaries, isolated scores. The disc gave us something streaming hasn\'t replaced.', 'Author' => 'Leo Vance'],
                ['Title' => 'Acting without dialogue', 'Excerpt' => 'The greatest performances are often the quietest. What does a face communicate when nobody speaks?', 'Author' => 'Otto Braun'],
            ],
            'Music' => [
                ['Title' => 'Free jazz and the politics of noise', 'Excerpt' => 'Ornette Coleman didn\'t just change music. He changed what music was allowed to say.', 'Author' => 'Dan Yates'],
                ['Title' => 'The producer as auteur', 'Excerpt' => 'From Phil Spector to Arca, the studio architect has always been the invisible author.', 'Author' => 'Rosa Field'],
                ['Title' => 'Field recording and the sounds of everywhere', 'Excerpt' => 'A growing movement of composers is trading instruments for microphones and walking out the door.', 'Author' => 'Dan Yates'],
                ['Title' => 'The return of the concept album', 'Excerpt' => 'Streaming killed the album. Then a handful of artists made records that only work front to back — and they sold.', 'Author' => 'Maya Hunt'],
                ['Title' => 'Club music as architecture', 'Excerpt' => 'A club track is designed for a specific room, a specific moment, a specific body. That\'s a form of building.', 'Author' => 'Dan Yates'],
                ['Title' => 'Why the music press stopped mattering', 'Excerpt' => 'It wasn\'t streaming that killed the weekly. It was the collapse of the idea that someone else knows better.', 'Author' => 'Maya Hunt'],
                ['Title' => 'The voice as instrument', 'Excerpt' => 'Technique is only interesting when it disappears. The singers worth listening to are the ones who forget they\'re singing.', 'Author' => 'Rosa Field'],
                ['Title' => 'Reissues and the archaeology of sound', 'Excerpt' => 'Every restored record is an argument about what matters. The selectors doing it now have strong opinions.', 'Author' => 'Maya Hunt'],
                ['Title' => 'Guitar music isn\'t dead, it just moved', 'Excerpt' => 'The guitar dropped out of the mainstream a decade ago. It turned up somewhere more interesting.', 'Author' => 'Dan Yates'],
                ['Title' => 'Listening rooms and the end of background music', 'Excerpt' => 'A small but growing number of venues exist purely for sitting and listening. That this is radical says everything.', 'Author' => 'Maya Hunt'],
            ],
            'Books' => [
                ['Title' => 'On rereading: what changes when you return to a book', 'Excerpt' => 'You are not the same reader. The book is not the same book. Something new has to give.', 'Author' => 'Alice Penn'],
                ['Title' => 'The short story is not the novel\'s lesser sibling', 'Excerpt' => 'Compression is not reduction. The finest short fiction achieves what novels cannot.', 'Author' => 'James Lowe'],
                ['Title' => 'Translation as interpretation', 'Excerpt' => 'Every translated book is two books. Understanding this changes everything about how we read world literature.', 'Author' => 'Alice Penn'],
                ['Title' => 'The editor\'s invisible hand', 'Excerpt' => 'We celebrate authors. The person who told them to cut chapters two, five, and seven goes uncredited.', 'Author' => 'Tom Ries'],
                ['Title' => 'Against the literary prize', 'Excerpt' => 'Prizes don\'t reward the best books. They reward the books that prize committees can agree on. That\'s different.', 'Author' => 'Alice Penn'],
                ['Title' => 'Poetry and the problem of the general reader', 'Excerpt' => 'Nobody reads poetry. Which is odd, because it\'s the form that gets closest to how thinking actually feels.', 'Author' => 'Tom Ries'],
                ['Title' => 'The notebook and the finished page', 'Excerpt' => 'Published journals are a strange artefact. They\'re private thought that decided it wanted to be seen.', 'Author' => 'James Lowe'],
                ['Title' => 'Why we still need the bookshop', 'Excerpt' => 'The physical bookshop is inefficient, expensive, and indispensable. The case for its survival isn\'t economic.', 'Author' => 'Tom Ries'],
                ['Title' => 'Genre fiction and the snob\'s blind spot', 'Excerpt' => 'The distinction between literary and genre fiction has always been about class more than craft.', 'Author' => 'Alice Penn'],
                ['Title' => 'First sentences and what they promise', 'Excerpt' => 'An opening line is a contract. The best ones are the ones you can\'t quite understand until the last page.', 'Author' => 'James Lowe'],
            ],
            'Politics' => [
                ['Title' => 'The infrastructure of forgetting', 'Excerpt' => 'Cities demolish their own history not through malice but through the bureaucratic logic of improvement.', 'Author' => 'Sam Cole'],
                ['Title' => 'Why local elections determine everything', 'Excerpt' => 'National politics gets the cameras. Local politics gets the decisions that actually affect daily life.', 'Author' => 'Rosa Field'],
                ['Title' => 'The commons and the city', 'Excerpt' => 'Public space is not neutral. Who it is built for, and who feels welcome in it, is always a political choice.', 'Author' => 'Sam Cole'],
                ['Title' => 'Language and the manufacture of consent', 'Excerpt' => 'The words politicians choose are not accidents. Unpacking them is one of the few acts of resistance available.', 'Author' => 'Zoe Marsh'],
                ['Title' => 'The technocrat\'s confidence', 'Excerpt' => 'Expertise has its place. The problem is when it becomes a reason not to ask who the expert is answering to.', 'Author' => 'Sam Cole'],
                ['Title' => 'What ballot design tells you about power', 'Excerpt' => 'The form of a ballot — who controls it, what it asks, how it is counted — is never politically neutral.', 'Author' => 'Zoe Marsh'],
                ['Title' => 'Housing as a political failure, not a market one', 'Excerpt' => 'Every country with a housing crisis chose to have one. Understanding that is where the argument has to start.', 'Author' => 'Rosa Field'],
                ['Title' => 'The newspaper and the idea of a public', 'Excerpt' => 'Mass media created the modern political public. Its collapse isn\'t just an industry story — it\'s a civic one.', 'Author' => 'Zoe Marsh'],
                ['Title' => 'Against the apolitical aesthetic', 'Excerpt' => 'Design, fashion, food: every supposedly neutral cultural sphere turns out to have politics running through it.', 'Author' => 'Sam Cole'],
                ['Title' => 'Care work and the economy that ignores it', 'Excerpt' => 'The most essential labour in any society is the least counted, the least paid, the least visible.', 'Author' => 'Zoe Marsh'],
            ],
        ];

        $sort = 2;
        foreach ($sections as $sectionTitle => $articles) {
            $section = ArticlesPage::get()->filter('Title', $sectionTitle)->first();
            if (!$section) {
                $section = ArticlesPage::create();
            }
            $section->Title      = $sectionTitle;
            $section->MenuTitle  = $sectionTitle;
            $section->URLSegment = strtolower($sectionTitle);
            $section->ParentID   = 0;
            $section->Sort       = $sort++;
            $section->write();
            $section->publishRecursive();
            $output->writeln("Section: $sectionTitle");

            foreach ($articles as $data) {
                $existing = ArticlePage::get()
                    ->filter(['Title' => $data['Title'], 'ParentID' => $section->ID])
                    ->first();
                if ($existing) {
                    $output->writeln("  - already exists: {$data['Title']}");
                    continue;
                }
                $article = ArticlePage::create();
                $article->Title    = $data['Title'];
                $article->Excerpt  = $data['Excerpt'];
                $article->Author   = $data['Author'];
                $article->Category = $sectionTitle;
                $article->ParentID = $section->ID;
                $article->Content  = '<p>' . $data['Excerpt'] . '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>';
                $article->write();
                $article->publishRecursive();
                $output->writeln("  + {$data['Title']}");
            }
        }

        $output->writeln('Done.');
        return Command::SUCCESS;
    }
}

}
