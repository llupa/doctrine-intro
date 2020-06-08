<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\PriceHistory;
use App\Repository\BookRepository;
use App\Repository\PriceHistoryRepository;
use DateTime;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function array_walk;
use function count;
use function in_array;
use function strtolower;

final class FindBookCommand extends Command
{
    protected static $defaultName = 'app:find:book';

    private $bookRepository;
    private $priceHistoryRepository;

    public function __construct(BookRepository $bookRepository, PriceHistoryRepository $priceHistoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->priceHistoryRepository = $priceHistoryRepository;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addOption('title', null, InputOption::VALUE_OPTIONAL)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Finding Book ...');

        $criteria = Criteria::create();
        $title = ($input->hasOption('title')) ? $input->getOption('title') : '';
        $id    = ($input->hasOption('id')) ? $input->getOption('id') : '';

        if (!empty($title)) {
            $byTitle = $criteria::expr()->eq('title', $title);
            $criteria->andWhere($byTitle);
        }

        if (!empty($id)) {
            $byId = $criteria::expr()->eq('id', $id);
            $criteria->andWhere($byId);
        }

        if (empty($title) && empty($id)) {
            $criteria::expr()->gt('id', 0);
        }

        /** @var Book[] $results */
        $results = $this->bookRepository->matching($criteria)->toArray();
        $rows = [];

        array_walk(
            $results,
            function (Book $book) use (&$rows) {
                $rows[$book->getId()] = [
                    $book->getId(),
                    $book->getTitle(),
                    $book->getPrice(),
                    $book->getPublisher()->getName(),
                    $book->getAuthors()->count()
                ];
            }
        );

        $io->table(['ID', 'Title', 'Price', 'Publisher', 'Author count'], $rows);

        if (count($results) === 0) {
            return Command::SUCCESS;
        }

        $answer = $io->ask('Do you want to show Authors for a Book listed above?', 'yes');

        if (in_array(strtolower($answer), ['y', 'yes'])) {
            $id = $io->ask('Type in the Book id');

            $book = $this->bookRepository->find($id);

            if (! $book instanceof Book) {
                $io->writeln("[$id] is not a valid book identifier.");

                return Command::SUCCESS;
            }

            $authors = $book->getAuthors()->toArray();

            if (empty($authors)) {
                $io->writeln('This book has no authors yet.');

                return Command::SUCCESS;
            }

            $entryRows = [];

            array_walk($authors, function (Author $author) use(&$entryRows, $book) { $entryRows[] = [$book->getTitle(), $author->getFullName()];});

            $io->table(['Book title', 'Author'], $entryRows);
        }

        $answer = $io->ask('Do you want to show price changes for a Book listed above?', 'yes');

        if (in_array(strtolower($answer), ['y', 'yes'])) {
            $id = $io->ask('Type in the Book id');

            $book = $this->bookRepository->find($id);

            if (! $book instanceof Book) {
                $io->writeln("[$id] is not a valid book identifier.");

                return Command::SUCCESS;
            }

            $entries = $this->priceHistoryRepository->findBy(['bookIdentifier' => $book->getId()]);

            if (empty($entries)) {
                $io->writeln('This book has no price changes yet.');

                return Command::SUCCESS;
            }

            $entryRows = [];

            array_walk(
                $entries,
                function (PriceHistory $history) use (&$entryRows, $book) {
                    $entryRows[] = [
                        $book->getTitle(),
                        $history->getPrice(),
                        $history->getCreatedAt()->format(DateTime::RFC3339)
                    ];
                }
            );

            $io->table(['Book title', 'Old price', 'Set on'], $entryRows);
            $io->table(['Book title', 'Current price'], [[$book->getTitle(), $book->getPrice()]]);
        }

        return Command::SUCCESS;
    }
}
