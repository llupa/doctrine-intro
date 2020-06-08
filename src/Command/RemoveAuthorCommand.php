<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class RemoveAuthorCommand extends Command
{
    protected static $defaultName = 'app:remove:author';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Removing Author ...');

        $id = (int) $input->getArgument('id');

        $author = $this->doctrine->getRepository(Author::class)->find($id);

        if (! $author instanceof Author) {
            $io->error("Given ID [$id] is not valid.");

            return Command::FAILURE;
        }

        $this->doctrine->getManager()->remove($author);
        $this->doctrine->getManager()->flush();

        $io->writeln("Publisher with [lastName][{$author->getLastName()}] was deleted successfully.");

        return Command::SUCCESS;
    }
}
