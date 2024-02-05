<?php

declare(strict_types=1);

$driver = 'mysql';
$config = http_build_query(data: [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',
], arg_separator: ';');

$dsn = "{$driver}:{$config}";
$username = 'root';
$password = '!mysqlBelchenkov88';

$db = new PDO($dsn, $username, $password);

echo "Connected to Database";
