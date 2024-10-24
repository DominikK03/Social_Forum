<?php

namespace app;

use PDO;
use PDOException;
use PDOStatement;

class MysqlClient implements MysqlClientInterface
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    public function createQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder();
    }

    public function getResults(Query $query): array
    {
        $statement = $this->pdo->prepare($query->showStatement());
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneOrNullResult(Query $query): ?array
    {
        $statement = $this->pdo->prepare($query->showStatement());
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function pushWithoutResults(Query $query)
    {
        $statement = $this->pdo->prepare($query->showStatement());
        $statement->execute();
    }
    public function rowCount(Query $query) : int
    {
        $statement = $this->pdo->prepare($query->showStatement());
        $statement->execute();
        return $statement->rowCount();
    }


}