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

final class RemoveAddressCommand extends Command
{
    protected static $defaultName = 'app:remove:address';

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
        $io->title('Removing Address ...');

        $id = (int) $input->getArgument('id');

        $address = $this->doctrine->getRepository(Address::class)->find($id);

        if (! $address instanceof Address) {
            $io->error("Given ID [$id] is not valid.");

            return Command::FAILURE;
        }

        $this->doctrine->getManager()->remove($address);
        $this->doctrine->getManager()->flush();

        $io->writeln("Publisher with [street][{$address->getStreet()}] was deleted successfully.");

        return Command::SUCCESS;
    }
}
