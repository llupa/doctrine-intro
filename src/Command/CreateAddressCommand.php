<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Address;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CreateAddressCommand extends Command
{
    protected static $defaultName = 'app:create:address';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addArgument('street', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Author ...');


        $street = $input->getArgument('street');

        if (empty($street)) {
            $io->error('Your Address\' street cannot be empty.');

            return Command::FAILURE;
        }

        $address = new Address();
        $address->setStreet($street);

        $this->doctrine->getManager()->persist($address);
        $this->doctrine->getManager()->flush();

        $io->writeln("Address with [street][$street] was created successfully.");

        return Command::SUCCESS;
    }
}
