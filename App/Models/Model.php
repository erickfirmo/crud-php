<?php

namespace App\Models;

class Model {

    protected $sql;

    protected $collection = [];

    public function setCollection(array $collection) : void
    {
        $this->collection = $collection;
    }

    public function addQuery(string $sql) : Object
    {
        $this->sql = $this->sql . $sql;

        return $this;
    }

    public function get() : array
    {
        return $this->collection;
    }

    public function orderByAsc() : Object
    {
        $this->addQuery('ORDER BY ASC');

        return $this;
    }

    public function orderByDesc() : Object
    {
        $this->addQuery('ORDER BY DESC');

        return $this;
    }

    public function all() : Object
    {
        $sql = "SELECT * FROM ".$this->table;
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $registers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->setCollection($registers);

        return $this;
    }

    public function insert(array $values)
    {
        $columns = array_keys($values);
        $values = array_values($values);
        $columns = implode(", ", $columns);
        $values = implode("', '", $values);

        $sql = "
            INSERT INTO ".$this->table." (".$columns.") VALUES ('".$values."');
            SELECT LAST_INSERT_ID();
        ";

        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $this->findById($db->lastInsertId());
    }

    public function update(int $id, array $values)
    { 
        $columns = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
            $values,
            array_keys($values)
        ));

        $sql = 'UPDATE '.$this->table.' SET '.$columns.' WHERE id='.$id;
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM '.$this->table.' WHERE id='.$id;
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);

        return $stmt->execute();
    }

    public function findById(int $id)
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $db = $this->getPDOConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getPDOConnection()
    {
        return (new \Connection())->getPDOConnection();
    }
}
