<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Publisher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CreatePublisherCommand extends Command
{
    protected static $defaultName = 'app:create:publisher';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('street', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Publisher ...');


        $name = $input->getArgument('name');

        if (empty($name)) {
            $io->error('Your Publisher\'s name cannot be empty.');

            return Command::FAILURE;
        }

        $street = $input->getArgument('street');

        $publisher = new Publisher();
        $publisher->setName($name);
        $publisher->getAddress()->setStreet($street);

        $this->doctrine->getManager()->persist($publisher);
        $this->doctrine->getManager()->flush();

        $io->writeln("Publisher with [name][$name] was created successfully.");

        return Command::SUCCESS;
    }
}
