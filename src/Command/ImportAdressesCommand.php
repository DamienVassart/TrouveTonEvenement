<?php

namespace App\Command;

use App\Services\ImportAdressesService;
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
    name: 'app:import:adresses',
    description: 'Import data from csv files to adresses table',
)]
class ImportAdressesCommand extends Command
{
    public function __construct(private ImportAdressesService $importAdressesService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('reset-import', null, InputOption::VALUE_NONE, 'Select this option to cleanup adresse and import_progress tables prior to begin import')
            ->addOption('reset', null, InputOption::VALUE_NONE, 'Select this option to cleanup adresse and import_progress tables')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->importAdressesService->importAdresses($io, $input->getOption('reset-import'), $input->getOption('reset'));

        return Command::SUCCESS;
    }
}
