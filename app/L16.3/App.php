<?php

class App 
{
    public SQLite3 $db;

    public function __construct()
    {
        $this->db = new SQLite3('mysqlitedb2.db');

        $this->db->exec("CREATE TABLE IF NOT EXISTS people (  
            id int NOT NULL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            surname VARCHAR(255) NOT NULL,
            city VARCHAR(30)
        );");
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function people(): array
    {
        $people = [];

        $result = $this->db->query('SELECT * FROM people');

        $row = $result->fetchArray();
        
        while ($row) {
            $people[] = $row;
            $row = $result->fetchArray();
        }

        return $people;
    }

    public function getActionPath(): string
    {
        // $dirpatharray = explode('/', __DIR__);
        // $submitPath = array_pop($dirpatharray);

        return 'http://localhost:8080/L16.3/';
    }

    public function handleRequest(): void
    {
        if (!empty($_POST['action'])) {
            $this->handlePostRequest($_POST['action']);
        }

        if (!empty($_GET['action'])) {
            $this->handleGetRequest($_GET['action']);
        }
    }

    public function handlePostRequest(string $type): void
    {
        switch ($type) {
            case 'create':
                $this->createAction();
                break;
            case 'delete':
                $this->deleteAction();
                break;
            case 'update':
                $this->updateAction();
                break;
        }
    }

    public function handleGetRequest(string $type): void
    {
        
    }

    public function createAction()
    {
        if (!empty($_POST['name']) && !empty($_POST['surname'])) {
            $this->db->exec("INSERT INTO people (id, name, surname) VALUES ({$this->getLatestID()}+1, '{$_POST['name']}', '{$_POST['surname']}')");
        }
    }

    public function deleteAction()
    {
        if (!empty($_POST['id'])) {
            $this->db->exec("DELETE FROM people WHERE id = {$_POST['id']}");
        }
    }

    public function updateAction()
    {
        if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
            $city = $_POST['city'] ?? '';

            $this->db->exec("UPDATE people SET name = '{$_POST['name']}', surname = '{$_POST['surname']}', city = '$city' WHERE id = {$_POST['id']}");
        }
    }

    public function getLatestID()
    {
        $result = $this->db->query('SELECT id FROM people ORDER BY id DESC');
        return $result->fetchArray()['id'];
    }

    public function showEditForm(): bool
    {
        return !empty($_GET['action']) && $_GET['action'] == 'edit';
    }

    public function getPerson(int $id): array|false
    {
        $editResult = $this->db->query("SELECT * FROM people WHERE id=$id");

        return $editResult->fetchArray();
    }
}