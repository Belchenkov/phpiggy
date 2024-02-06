<?php

declare(strict_types=1);

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',
], 'root', '!mysqlBelchenkov88');

$query = 'SELECT * FROM users';

$stmt = $db->connection->query($query, PDO::FETCH_ASSOC);

