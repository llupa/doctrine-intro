<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CreateAuthorCommand extends Command
{
    protected static $defaultName = 'app:create:author';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addArgument('firstName', InputArgument::REQUIRED)
            ->addArgument('lastName', InputArgument::REQUIRED)
            ->addOption('middleName', null,InputOption::VALUE_OPTIONAL);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Author ...');


        $firstName = $input->getArgument('firstName');
        $lastName = $input->getArgument('lastName');

        if (empty($firstName) || empty($lastName)) {
            $io->error('Your Author first name or last name cannot be empty.');

            return Command::FAILURE;
        }

        $middleName = ($input->hasOption('middleName')) ? $input->getOption('middleName') : '';

        $author = new Author();
        $author
            ->setFirstName($firstName)
            ->setMiddleName($middleName)
            ->setLastName($lastName);

        $this->doctrine->getManager()->persist($author);
        $this->doctrine->getManager()->flush();

        $io->writeln("Author named [$firstName $middleName $lastName] was created successfully.");

        return Command::SUCCESS;
    }
}
