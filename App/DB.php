<?php

namespace App;


class DB
{
    use Singletone;

    protected $dbh;
    private $exc;

    protected function __construct()
    {
        try {
            $config = Config::instance();
        } catch (MultiException $e) {
            $e[] = new \App\Exceptions\Core($e->getMessage());
            throw $e;
        }

        $dsn = $config->item['db']['default']['driver'] . ':host=' . $config->item['db']['default']['host'] . ';dbname=' . $config->item['db']['default']['dbname'];

        $this->exc = new MultiException();
        try {
            $this->dbh = new \PDO($dsn, $config->item['db']['default']['user'], $config->item['db']['default']['password']);
        } catch (\PDOException $pdo_e) {
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }
    }

    public function execute($sql, array $substitutionData = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutionData);
        } catch (\PDOException $pdo_e) {
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }

        return $res;
    }

    public function query($sql, $class, array $substitutionData = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutionData);
        } catch (\PDOException $pdo_e) {
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }

        if (false !== $res) {
            $res = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
            return $res;
        }

        return [];
    }
}