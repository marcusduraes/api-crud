<?php

require_once './config.php';

class dbConnection
{
    private $host, $username, $password, $dbName, $conn;
    public function __construct()
    {
        $this->host = HOST;
        $this->username = USER;
        $this->password = PASSWORD;
        $this->dbName = DBNAME;
    }

    public function connect(): void
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($conn->connect_error) {
            die("Erro: $conn->connect_error");
        }

        $this->conn = $conn;
    }

    public function index(): string
    {
        $rows = [];
        $result = $this->conn->query("SELECT * FROM songs");
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return print_r(json_encode($rows, JSON_PRETTY_PRINT));
    }

    public function store()
    {
        $this->conn->query("INSERT INTO songs VALUES ('0', '$_GET[item]')");
        print_r($_GET['item']);
    }

    public function delete()
    {
        $uri = array_filter(explode("/", parse_url($_SERVER['REQUEST_URI'])['path']), function ($el) {
            return $el != "";
        });
        $id = current($uri);
        if (end($uri) == 'delete') {
            $this->conn->query("DELETE FROM songs WHERE id = $id");
            print_r(current($uri));
        }
    }
}

$dbConnection = new dbConnection();
$dbConnection->connect();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $dbConnection->index();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbConnection->store();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $dbConnection->delete();
}
