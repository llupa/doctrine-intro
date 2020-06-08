<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CreateBookCommand extends Command
{
    protected static $defaultName = 'app:create:book';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addArgument('title', InputArgument::REQUIRED)
            ->addArgument('price', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Publisher ...');


        $title = $input->getArgument('title');
        $price = $input->getArgument('price');

        if (empty($title) || empty($price)) {
            $io->error('Your Book title or price cannot be empty.');

            return Command::FAILURE;
        }

        $book = new Book();
        $book
            ->setTitle($title)
            ->setPrice($price);

        $this->doctrine->getManager()->persist($book);
        $this->doctrine->getManager()->flush();

        $io->writeln("Book with [title][$title] was created successfully.");

        return Command::SUCCESS;
    }
}
