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
            //var_dump($config);
            $e[] = new \App\Exceptions\Core($e->getMessage());
            throw $e;
        } finally {
            //TODO: реализовать обращение к Config через ArrayAccess (см. Т4): $config->item->db->default->driver
            //var_dump($config->item->db);

        }


        $dsn = $config->item['db']['default']['driver'] . ':host=' . $config->item['db']['default']['host'] . ';dbname=' . $config->item['db']['default']['dbname'];

        $this->exc = new MultiException();
        try {
            $this->dbh = new \PDO($dsn, 'root', '');
        } catch (\PDOException $pdo_e) {
            //var_dump($e->getMessage());
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
            //throw new \App\Exceptions\DB($e->getMessage());
        }
    }

    public function execute($sql, array $substitutionData = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutionData);
        } catch (\PDOException $pdo_e) {
            //throw new \App\Exceptions\DB($pdo_e->getMessage());
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }

        /*
        echo "\nPDOStatement::errorInfo():\n";
        print_r($sth->errorInfo());
        echo "\nPDOStatement::errorCode(): ";
        print $sth->errorCode();
        */

        return $res;
    }

    public function query($sql, $class, array $substitutionData = [])
    {
        try {
            #$sth = $this->dbh->prepare('1111'.$sql.'####'); // Пример некоректного запроса

            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutionData);

            /*
            echo "<br>PDOStatement::errorInfo(): ";
            print_r($sth->errorInfo());
            echo "<br>PDOStatement::errorCode(): ";
            print $sth->errorCode();
            */


        } catch (\PDOException $pdo_e) {
            //throw new \App\Exceptions\DB($e->getMessage());
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }

        if (false == $sth->errorCode()) {
            $this->exc[] = new \App\Exceptions\DB($pdo_e->getMessage());
            throw $this->exc;
        }


        //var_dump($substitutionData);
        //echo $sql."<br>";
        if (false !== $res) { // !== - жесткое неравенство со сравнением по типу
            $res = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
            return $res;
        }
        return [];
    }

}