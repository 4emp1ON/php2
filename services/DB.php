<?php
namespace App\services;

class DB
{
    use TSingleton;

    protected $connection;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '8889',
        'dbname' => 'gbphp',
        'charset' => 'UTF8',
        'username' => 'root',
        'password' => 'xq4q5r',
    ];

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \PDO(
                $this->getDsn(),
                $this->config['username'],
                $this->config['password']
            );
            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connection;
    }

    private function getDsn()
    {
        return sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
                $this->config['driver'],
                $this->config['host'],
                $this->config['port'],
                $this->config['dbname'],
                $this->config['charset']
        );
    }

    protected function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function find($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function findAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function findObject($sql, $className, $params = [])
    {
        $statement = $this->query($sql, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $statement->fetch();
    }

    public function findAllObjects($sql, $className, $params = [])
    {
        $statement = $this->query($sql, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $statement->fetchAll();
    }

    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }
    public function lastInsertId ()
    {
        return $this->getConnection()->lastInsertId();
    }
}
