<?php

namespace App\Command;

use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ### Test Task 2 ###
 * I think in this situation is better to create another one command for fourth post with specific requirements for post
 * creation, so we can configure cron job to generate each day additional post at 12 PM and not affect any other logic
 */
class GenerateDailyExtraPostCommand extends Command
{
    protected static $defaultName = 'app:generate-daily-extra-post';
    protected static $defaultDescription = 'Test Task 2: Run app:generate-daily-extra-post';

    private PostManager $postManager;
    private LoremIpsum $loremIpsum;

    public function __construct(PostManager $postManager, LoremIpsum $loremIpsum, string $name = null)
    {
        parent::__construct($name);
        $this->postManager = $postManager;
        $this->loremIpsum = $loremIpsum;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $date = (new \DateTime('now'))->format('Y-m-d');
        $title = "Summary $date";
        $content = $this->loremIpsum->paragraphs();

        $this->postManager->addPost($title, $content);

        $output->writeln('A random post has been generated.');

        return Command::SUCCESS;
    }
}
