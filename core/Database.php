<?php

namespace Core;

class Database
{

    protected \PDO $connection;
    protected \PDOStatement $stmt;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_SETTINGS['host'] . ";dbname=" . DB_SETTINGS['database'] . ";charset=" . DB_SETTINGS['charset'];
        try {
            $this->connection = new \PDO($dsn, DB_SETTINGS['username'], DB_SETTINGS['password'], DB_SETTINGS['options']);
        } catch (\PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] DB Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            abort('DB error connection', 500);
        }
        return $this;
    }



    public function query(string $query, array $params = []): static
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    public function get(): array|false
    {
        return $this->stmt->fetchAll();
    }

    public function getAssoc($key = 'id'): array //по названию поля
    {
        $data = [];
        while ($row = $this->stmt->fetch()) {
            $data[$row[$key]] = $row;
        }
        return $data;
    }

    public function getOne() //получить первый элемент
    {
        return $this->stmt->fetch();
    }

    public function getColumn() //число записей
    {
        return $this->stmt->fetchColumn();
    }

    public function findAll($tbl): array|false //получить все поля
    {
        $this->query("select * from {$tbl}");
        return $this->stmt->fetchAll();
    }

    public function findOne($tbl, $value, $key = 'id') //получит конкретное значение по фильтру
    {
        $this->query("select * from {$tbl} where $key = ? LIMIT 1", [$value]);
        return $this->stmt->fetch();
    }


    public function getInsertId(): false|string //последняя добавленная запись
    {
        return $this->connection->lastInsertId();
    }

    //____________________________транзакции
    public function beginTransaction(): bool //инициализациия
    {
        return $this->connection->beginTransaction();
    }

    public function commit(): bool //потвердить
    {
        return $this->connection->commit();
    }

    public function rollBack(): bool //откатить
    {
        return $this->connection->rollBack();
    }
    //____________________________транзакции
}
