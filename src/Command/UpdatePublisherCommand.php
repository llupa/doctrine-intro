<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Publisher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function in_array;

final class UpdatePublisherCommand extends Command
{
    protected static $defaultName = 'app:update:publisher';

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Update Publisher');

        $exit = false;

        do {
            $answer = $io->ask('Which Publisher would you like to update? (type exit or quit to finish)', '??');

            if (in_array($answer, ['quit', 'exit'])) {
                $exit = true;
                continue;
            }

            if ($answer === '??') {
                $this->getApplication()->find('app:find:publisher')->execute(new StringInput(''), new ConsoleOutput());
                continue;
            }

            $publisher = $this->doctrine->getRepository(Publisher::class)->find($answer);

            if (! $publisher instanceof Publisher) {
                $io->writeln("[$answer] is not a valid Publisher identifier.");
                continue;
            }

            $name = $io->ask('Enter new name or leave empty to skip', '');

            if (!empty($name)) {
                $publisher->setName($name);
            }

            $street = $io->ask('Enter new address or leave empty to skip', '');

            if (!empty($street)) {
                $publisher->getAddress()->setStreet($street);
            }

            $this->doctrine->getManager()->flush();

            $io->writeln("Publisher with [name][{$publisher->getName()}] was updated successfully.");
        } while (!$exit);

        return Command::SUCCESS;
    }
}
