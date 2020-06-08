<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function array_walk;

final class FindPublisherCommand extends Command
{
    protected static $defaultName = 'app:find:publisher';

    private $repository;

    public function __construct(PublisherRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addOption('name', null, InputOption::VALUE_OPTIONAL)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Finding Publisher ...');

        $criteria = Criteria::create();
        $name = ($input->hasOption('name')) ? $input->getOption('name') : '';
        $id   = ($input->hasOption('id')) ? $input->getOption('id') : '';

        if (!empty($name)) {
            $byName = $criteria::expr()->eq('name', $name);
            $criteria->andWhere($byName);
        }

        if (!empty($id)) {
            $byId = $criteria::expr()->eq('id', $id);
            $criteria->andWhere($byId);
        }

        if (empty($name) && empty($id)) {
            $criteria::expr()->gt('id', 0);
        }

        /** @var Publisher[] $results */
        $results = $this->repository->matching($criteria)->toArray();
        $rows = [];

        array_walk($results, function (Publisher $publisher) use (&$rows) { $rows[] = [$publisher->getId(), $publisher->getName()]; });

        $io->table(['ID', 'Name'], $rows);

        return Command::SUCCESS;
    }
}
