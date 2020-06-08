<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function array_walk;

final class FindBookCommand extends Command
{
    protected static $defaultName = 'app:find:book';

    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;

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
        $results = $this->repository->matching($criteria)->toArray();
        $rows = [];

        array_walk($results, function (Book $book) use (&$rows) { $rows[] = [$book->getId(), $book->getTitle(), $book->getPrice()]; });

        $io->table(['ID', 'Title', 'Price'], $rows);

        return Command::SUCCESS;
    }
}
