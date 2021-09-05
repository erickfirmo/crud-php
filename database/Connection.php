<?php

class Connection
{
    protected $config;

    public function __construct() {
        $this->setConfig();
        return $this->getPDOConnection();
    }

    public function getConfig($config) {
        return $this->config[$config];
    }

    public function getPDOConnection() {
        $dsn = 'mysql:host='.$this->getConfig('host').';dbname='.$this->getConfig('database');
        try {
            $pdo = new PDO($dsn, $this->getConfig('user'), $this->getConfig('password'));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $ex) {
            print 'Error: '.$ex->getMessage();
        }
    }

    public function setConfig() {
        $this->config = include __DIR__.'/../config/database.php';
    }
}