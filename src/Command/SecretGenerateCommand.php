<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:secret:generate',
    description: 'Generates a new APP_SECRET and puts it into .env.local',
)]
class SecretGenerateCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $a = "0123456789abcdef";
        $secret = '';

        for ($i = 0; $i < 32; $i++) {
            $secret .= $a[rand(0, 15)];
        }

        $dotEnvFile = ".env.local";
        $content = file_get_contents($dotEnvFile);
        $content .= 'APP_SECRET=' .$secret . PHP_EOL;
        file_put_contents($dotEnvFile, $content);

        $io->success('New APP_SECRET was generated: ' .  $secret);

        return Command::SUCCESS;
    }
}
