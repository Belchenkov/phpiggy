<?php

declare(strict_types=1);

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',
], 'root', '!mysqlBelchenkov88');

$sql_file = file_get_contents("./database.sql");

$db->connection->query($sql_file);
