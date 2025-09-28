<?php

//$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// use Dom\Mysql;

// class ReportGenerator
// {
//     public function generate()
//     {
//         $db = new mysqli("127.0.0.1", "root", "interview@pass123", "interview", 4406);
//         $result = $db->query("SELECT * FROM users");
//         foreach ($result as $row) {
//             echo $row['email'] . "\n";
//         }
//     }
// }

// $reportGenerator = new ReportGenerator();
// $reportGenerator->generate();

interface connection
{
    public function connect($host, $user, $password, $database, $port);
}

class mysqlConnection implements connection
{
    public function connect($host, $user, $password, $database, $port)
    {
        $db = new mysqli($host, $user, $password, $database, $port);
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } else {
            return $db;
        }
    }
}
class ReportGenerator2
{
    private $connection;
    private $mysqlConnection;
    public function __construct(connection $connection)
    {
        $this->connection = $connection;
    }

    public function generate()
    {
        $this->mysqlConnection = $this->connection->connect("127.0.0.1", "root", "interview@pass123", "interview", 4406);
        $result = $this->mysqlConnection->query("SELECT * FROM users");
        foreach ($result as $row) {
            echo $row['email'] . "\n";
        }
    }
}
$reportGenerator = new ReportGenerator2(new mysqlConnection());
$reportGenerator->generate();
