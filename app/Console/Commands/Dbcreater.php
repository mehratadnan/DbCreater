<?php

namespace App\Console\Commands;


use App\Models\CreateDB;
use Illuminate\Console\Command;
use PDO;
use PDOException;

class Dbcreater extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new database';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'db:create {host} {port} {username} {password} {database} ';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $DB_CHARSET = 'utf8';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $DB_COLLATION = 'utf8_general_ci';



    /**
     * @retun void
     */
    public function  __construct()
    {
        parent::__construct();
    }

    public function  handle()
    {
        $host = $this->argument('host');
        $port = $this->argument('port');
        $username = $this->argument('username');
        $password = $this->argument('password');
        $database = $this->argument('database');
        $this->fire($host,$port,$username,$password,$database);
    }


    /**
     * Execute the console command.
     * @param $host
     * @param $port
     * @param $username
     * @param $password
     * @param $database
     */

    public function fire($host,$port,$username,$password,$database)
    {
        try {
            $pdo = $this->getPDOConnection($host, $port, $username, $password);
            $pdo->exec(sprintf(
                'CREATE DATABASE %s CHARACTER SET %s COLLATE %s',
                $database,
                $this->DB_CHARSET,
                $this->DB_COLLATION,
            ));

            $this->info(sprintf('Successfully created %s database', $database));
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));
        }
    }

    /**
     * @param string $host
     * @param integer $port
     * @param string $username
     * @param string $password
     * @return PDO
     */
    private function getPDOConnection(string $host, int $port, string $username, string $password): PDO
    {
        return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }


}

