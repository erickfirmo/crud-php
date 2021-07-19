<?php

namespace App\Models;

class Model {

    protected $sql;

    protected $collection = [];

    protected $statement;

    protected $db;

    protected $perPage;

    protected $links;

    public function setStatement() : void
    {
        $this->statement = $this->connect()->prepare($this->getSql());
    }

    public function setLink(int $count) : void
    {
        $rest = $count % $this->perPage;
        $pages = $count / $this->perPage;
        $pages = $rest > 0 ? ($pages + 1) : $pages;
        $this->links = array_keys(array_fill(1, $pages, null));
    }

    public function clearQuery() : void
    {
        $this->sql = null;
    }

    public function connect() : Object
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

    public function paginate(int $perPage=10, $page=1)
    {  
        $page = isset($_GET['page']) ? $_GET['page'] : $page;
        
        /* busca uma determinada quantidade de itens */
        $start = ($page * $perPage) - $perPage;
        $this->addQuery(' LIMIT '.$start.', '.$perPage);
        $this->setStatement();
        $this->statement->execute();
        $registers = $this->statement->fetchAll(\PDO::FETCH_ASSOC);

        /* define quantidade de itens por página */
        $this->perPage = $perPage;

        /* limpa query */
        $this->clearQuery();

        /* define links */
        $this->addQuery('SELECT COUNT(*) FROM '.$this->table);
        $this->setStatement();
        $this->statement->execute();
        $count = $this->statement->fetchColumn();
        $this->setLink($count);

        /* define collection */
        $this->setCollection($registers);

        return $this->collection;
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

        $values = implode(', ', array_map(
            function ($v) { return sprintf("'%s'", addslashes($v)); },
            $values
        ));

        $sql = "INSERT INTO ".$this->table." (".$columns.") VALUES (".$values.")";
        $this->addQuery($sql);
        $this->setStatement();

        $this->statement->execute();

        return $this->findById($this->db->lastInsertId());
    }

    public function update(int $id, array $values)
    { 
        $this->clearQuery();

        $columns = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s='%s'", $k, addslashes($v)); },
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

        $registers = $this->statement->fetch();

        #dd($registers);

        $this->setCollection($registers, true);

        return $this->collection->items;
    }

    public function setCollection(array $registers, $singleRegister=false, array $items = [], $item = null) : void
    {
        if($singleRegister) {
            $items = (object) $registers;
        } else {
            foreach($registers as $register) {
                $item = (object) $register;
                array_push($items, $item);
            }
        }
        

        $collection = new \stdClass;
        $collection->items = $items;
        $collection->links = $this->links;
        
        $this->collection = $collection;
    }

    public function getPDOConnection()
    {
        return (new \Connection())->getPDOConnection();
    }
}
