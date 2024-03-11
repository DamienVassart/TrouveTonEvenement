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
    name: 'app:database:seturl',
    description: 'Will set DATABASE_URL in .env.local',
)]
class DatabaseSeturlCommand extends Command
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

        $io->title('Set database URL');

        $dotEnvFile = ".env.local";
        $content = file_get_contents($dotEnvFile);

        // database, username, password, host, port, dbName, serverVersion
        $database = $io->ask('Which database do you want to use ? [sqlite, mysql, postgresql]', 'mysql', function(string $database): string {
            return $database;
        });

        $username = $io->ask('Database username: ', null, function (string $username): string {
            if (empty($username)) {
                throw new \RuntimeException('Username cannot be empty');
            }

            return $username;
        });

        $password = $io->askHidden('Password for that user (can be empty): ', function (string $password): string {
            if (empty($password)) {
                return '';
            }

            return ':' . $password;
        } );

        $host = $io->ask('Database host: ', '127.0.0.1', function(string $host): string {
            return $host;
        });

        $port = $io->ask('Database port: ', '3306', function (string $port): string {
            return  $port;
        });

        $dbName = $io->ask('Database name: ', null, function (string $dbName): string {
            if (empty($dbName)) {
                throw new \RuntimeException('Database name cannot be empty');
            }

            return $dbName;
        });

        $serverVersion = $io->ask('Server version: ', null, function (string $serverVersion): string {
            if (empty($serverVersion)) {
                throw new \RuntimeException('Server version must ne specified');
            }

            return $serverVersion;
        });

        $url = $database . '://' . $username . $password . '@' . $host . ':' . $port . '/' . $dbName . '?serverVersion=' . $serverVersion;

        $content .= 'DATABASE_URL=' . $url . PHP_EOL;
        file_put_contents($dotEnvFile, $content);

        $io->success('Database URL set successfully to ' . $url);

        return Command::SUCCESS;
    }
}
