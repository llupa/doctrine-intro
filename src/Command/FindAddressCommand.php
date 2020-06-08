<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function array_walk;

final class FindAddressCommand extends Command
{
    protected static $defaultName = 'app:find:address';

    private $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addOption('street', null, InputOption::VALUE_OPTIONAL)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Finding Address ...');

        $criteria = Criteria::create();
        $street = ($input->hasOption('street')) ? $input->getOption('street') : '';
        $id = ($input->hasOption('id')) ? $input->getOption('id') : '';

        if (!empty($street)) {
            $byName = $criteria::expr()->eq('street', $street);
            $criteria->andWhere($byName);
        }

        if (!empty($id)) {
            $byId = $criteria::expr()->eq('id', $id);
            $criteria->andWhere($byId);
        }

        if (empty($street) && empty($id)) {
            $criteria::expr()->gt('id', 0);
        }

        /** @var Address[] $results */
        $results = $this->repository->matching($criteria)->toArray();
        $rows = [];

        array_walk($results, function (Address $address) use (&$rows) { $rows[] = [$address->getId(), $address->getStreet()]; });

        $io->table(['ID', 'Street'], $rows);

        return Command::SUCCESS;
    }
}
