<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function array_walk;

final class FindAuthorCommand extends Command
{
    protected static $defaultName = 'app:find:author';

    private $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addOption('firstName', null, InputOption::VALUE_OPTIONAL)
            ->addOption('middleName', null, InputOption::VALUE_OPTIONAL)
            ->addOption('lastName', null, InputOption::VALUE_OPTIONAL)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Finding Author ...');

        $criteria   = Criteria::create();
        $firstName  = ($input->hasOption('firstName')) ? $input->getOption('firstName') : '';
        $middleName = ($input->hasOption('middleName')) ? $input->getOption('middleName') : '';
        $lastName   = ($input->hasOption('lastName')) ? $input->getOption('lastName') : '';
        $id         = ($input->hasOption('id')) ? $input->getOption('id') : '';

        if (!empty($firstName)) {
            $byFirstName = $criteria::expr()->eq('firstName', $firstName);
            $criteria->andWhere($byFirstName);
        }

        if (!empty($middleName)) {
            $byMiddleName = $criteria::expr()->eq('middleName', $middleName);
            $criteria->andWhere($byMiddleName);
        }

        if (!empty($lastName)) {
            $byLastName = $criteria::expr()->eq('lastName', $lastName);
            $criteria->andWhere($byLastName);
        }

        if (!empty($id)) {
            $byId = $criteria::expr()->eq('id', $id);
            $criteria->andWhere($byId);
        }

        if (empty($firstName) && empty($middleName) && empty($lastName) && empty($id)) {
            $criteria::expr()->gt('id', 0);
        }

        /** @var Book[] $results */
        $results = $this->repository->matching($criteria)->toArray();
        $rows = [];

        array_walk($results, function (Author $author) use (&$rows) { $rows[] = [$author->getId(), $author->getFirstName(), $author->getMiddleName(), $author->getLastName()]; });

        $io->table(['ID', 'First name', 'Middle name', 'Last name'], $rows);

        return Command::SUCCESS;
    }
}
