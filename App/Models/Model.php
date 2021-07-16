<?php

namespace App\Models;

class Model {

    protected $sql;

    protected $collection = [];

    protected $statement;

    protected $db;

    public function setStatement()
    {
        $this->statement = $this->connect()->prepare($this->getSql());
    }

    public function setCollection(array $collection) : void
    {
        $this->collection = $collection;
    }

    public function clearQuery() {
        $this->sql = null;
    }

    public function connect()
    {
        return $this->db = $this->getPDOConnection();
    }

    public function addQuery(string $sql) : Object
    {
        $this->sql = $this->sql . $sql;

        return $this;
    }

    public function get() : array
    {
        $this->statement->execute();
        $registers = $this->statement->fetchAll(\PDO::FETCH_ASSOC);
        $this->setCollection($registers);

        return $this->collection;
    }

    public function first() : array
    {
        return array_pop($this->collection);
    }

    public function last() : array
    {
        return end($this->collection);
    }

    public function limit(int $limit) : Object
    {
        $this->addQuery(' LIMIT '.$limit);
        $this->setStatement();

        return $this;
    }

    public function orderByAsc() : Object
    {
        $this->addQuery(' ORDER BY id ASC');
        $this->setStatement();

        return $this;
    }

    public function orderByDesc() : Object
    {
        $this->addQuery(' ORDER BY id DESC');
        $this->setStatement();

        return $this;
    }

    public function getSql()
    {
        return $this->sql;
    }

    public function select() : Object
    {
        $this->clearQuery();
        $sql = "SELECT * FROM ".$this->table;
        $this->addQuery($sql);

        return $this;
    }

    public function insert(array $values)
    {
        $this->clearQuery();

        $columns = array_keys($values);
        $values = array_values($values);
        $columns = implode(", ", $columns);
        $values = implode("', '", $values);

        $sql = "INSERT INTO ".$this->table." (".$columns.") VALUES ('".$values."')";
        $this->addQuery($sql);
        $this->setStatement();

        $this->statement->execute();

        return $this->findById($this->db->lastInsertId());
    }

    public function update(int $id, array $values)
    { 
        $this->clearQuery();

        $columns = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
            $values,
            array_keys($values)
        ));

        $sql = 'UPDATE '.$this->table.' SET '.$columns.' WHERE id='.$id;
        $this->addQuery($sql);
        $this->setStatement();

        return $this->statement->execute();
    }

    public function delete(int $id)
    {
        $this->clearQuery();

        $sql = 'DELETE FROM '.$this->table.' WHERE id='.$id;
        $this->addQuery($sql);
        $this->setStatement();

        return $this->statement->execute();
    }

    public function findById(int $id)
    {
        $this->clearQuery();

        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $this->addQuery($sql);
        $this->setStatement();

        $this->statement->execute();

        return  $this->statement->fetch();
    }

    public function getPDOConnection()
    {
        return (new \Connection())->getPDOConnection();
    }
}
