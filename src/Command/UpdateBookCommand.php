<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class UpdateBookCommand extends Command
{
    protected static $defaultName = 'app:update:book';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Update Book');

        $exit = false;

        do {
            $answer = $io->ask('Which Book would you like to update? (type exit or quit to finish)', '??');

            if (in_array($answer, ['quit', 'exit'])) {
                $exit = true;
                continue;
            }

            if ($answer === '??') {
                $this->getApplication()->find('app:find:book')->execute(new StringInput(''), new ConsoleOutput());
                continue;
            }

            $book = $this->doctrine->getRepository(Book::class)->find($answer);

            if (! $book instanceof Book) {
                $io->writeln("[$answer] is not a valid Book identifier.");
                continue;
            }

            $price = $io->ask('Enter new price or leave empty to skip', '');

            if (!empty($price)) {
                $book->setPrice($price);
            }

            $this->doctrine->getManager()->flush();

            $io->writeln("Book with [title][{$book->getTitle()}] was updated successfully.");
        } while (!$exit);

        return Command::SUCCESS;
    }
}
