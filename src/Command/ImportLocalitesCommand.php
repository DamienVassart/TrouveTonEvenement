<?php

namespace App\Command;

use App\Services\ImportLocalitesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Damien Vassart
 */
#[AsCommand(
    name: 'app:import:localites',
    description: 'Import data from csv files to localites table',
)]
class ImportLocalitesCommand extends Command
{
    public function __construct(private ImportLocalitesService $importLocalitesService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->importLocalitesService->importLocalites($io);

        return Command::SUCCESS;
    }
}
