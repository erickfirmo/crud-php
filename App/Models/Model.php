<?php

namespace App\Models;

class Model {

    protected $sql;

    protected $collection = [];

    protected $statement;

    protected $db;

    protected $perPage;

    public $links;

    // realiza conexão com o banco de dados
    public function connect() : Object
    {
        return $this->db = (new \Connection())->getPDOConnection();
    }

    // seta statement
    public function setStatement() : void
    {
        $this->statement = $this->connect()->prepare($this->getSql());
    }

    // seta array de links da paginação
    public function setLink(int $count) : void
    {
        $rest = $count % $this->perPage;
        $pages = $count / $this->perPage;
        $pages = $rest > 0 ? ($pages + 1) : $pages;
        $this->links = array_keys(array_fill(1, $pages, null));
    }

    // limpa query do objeto
    public function clearQuery() : void
    {
        $this->sql = null;
    }

    // acrescenta query a query já existente
    public function addQuery(string $sql) : Object
    {
        $this->sql = $this->sql . $sql;

        return $this;
    }

    // seta objeto com os registros da consulta
    public function setCollection(array $registers, $singleRegister=false, array $items = [], $item = null) : void
    {
        $modelName = get_called_class();

        if($singleRegister) {
            $items = (object) $registers;
        } else {
            foreach($registers as $register) {
                $item = new $modelName;
                // cria objeto model baseado no fillable
                foreach ($this->fillable as $f) {
                    $item->$f = $register[$f];
                }

                array_push($items, $item);
            }
        }

        $collection = new \stdClass;
        $collection->items = $items;
        $collection->links = $this->links;
        
        $this->collection = $collection;
    }

    // retorna objeto com os registros buscados
    public function get() : Object
    {
        $this->statement->execute();

        $registers = $this->statement->fetchAll(\PDO::FETCH_ASSOC);

        $this->setCollection($registers);

        return $this->collection;
    }

    // seta limite de dados da consulta
    public function limit(int $limit) : Object
    {
        $this->addQuery(' LIMIT '.$limit);
        $this->setStatement();

        return $this;
    }

    // retorna registros com paginação
    public function paginate(int $perPage=10, $page=1)
    {  
        $page = isset($_GET['page']) ? $_GET['page'] : $page;

        // verifica se valor da paginação não é numerico
        if(!is_numeric($page) || $page == null) {
            $page = 1;
        }
        
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

    // ordena regitros em ordem crescente
    public function orderByAsc() : Object
    {
        $this->addQuery(' ORDER BY id ASC');
        $this->setStatement();

        return $this;
    }

    // ordena regitros em ordem decrescente
    public function orderByDesc() : Object
    {
        $this->addQuery(' ORDER BY id DESC');
        $this->setStatement();

        return $this;
    }

    // retorna query
    public function getSql()
    {
        return $this->sql;
    }

    // busca registros
    public function select() : Object
    {
        $this->clearQuery();
        $sql = "SELECT * FROM ".$this->table;
        $this->addQuery($sql);
        $this->setStatement();

        return $this;
    }

    // salva registro
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

    // atualiza registro
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

    // deleta registro
    public function delete(int $id)
    {
        $this->clearQuery();

        $sql = 'DELETE FROM '.$this->table.' WHERE id='.$id;
        $this->addQuery($sql);
        $this->setStatement();

        return $this->statement->execute();
    }

    // busca registro pelo id
    public function findById(int $id)
    {
        $this->clearQuery();

        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $this->addQuery($sql);
        $this->setStatement();

        $this->statement->execute();

        $registers = $this->statement->fetch();

        $this->setCollection($registers, true);

        return $this->collection->items;
    }
}
