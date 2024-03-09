<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Damien Vassart
 * @note pass these arguments:
 * database [sqlite, mysql, postgresql] - !Required
 * db_username - !Required
 * db_name (the name of the database) - !Required
 * server_version - !Required
 * [db_password] - ?optional
 * [host] - ?optional - default value:  127.0.0.1
 * [port] - ?optional - default value: 3306
 */
#[AsCommand(
    name: 'app:database:define',
    description: 'Will define DATABASE_URL in .env.local',
)]
class DatabaseDefineCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('database', InputArgument::REQUIRED, 'sqlite, mysql, postgresql')
            ->addArgument('db_username', InputArgument::REQUIRED, 'username')
            ->addArgument('db_name', InputArgument::REQUIRED, 'name fo the database')
            ->addArgument('server_version', InputArgument::REQUIRED, 'server version')
//            default: no password (empty string)
            ->addArgument('db_password', InputArgument::OPTIONAL, 'password')
//            default host: 127.0.0.1
            ->addArgument('host', InputArgument::OPTIONAL, 'host ip or localhost')
//            default port: 3306
            ->addArgument('port', InputArgument::OPTIONAL, 'port')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $dotEnvFile = ".env.local";
        $content = file_get_contents($dotEnvFile);

        $database = $input->getArgument('database');
        $username = $input->getArgument('db_username');

        $password = '';
        if ($input->getArgument('db_password')) {
            $password = ':' . $input->getArgument('db_password');
        }

        $host = '127.0.0.1';
        if ($input->getArgument('host')) {
            $host = $input->getArgument('host');
        }

        $port = '3306';
        if ($input->getArgument('port')) {
            $port = $input->getArgument('port');
        }

        $dbName = $input->getArgument('db_name');
        $serverVersion = $input->getArgument('server_version');

        $url = $database . "://" . $username . $password . '@' . $host . ':' . $port . '/' . $dbName . '?serverVersion=' . $serverVersion;

        $content .= 'DATABASE_URL=' . $url . PHP_EOL;
        file_put_contents($dotEnvFile, $content);

        $io->success('Database URL successfully created');

        return Command::SUCCESS;
    }
}
