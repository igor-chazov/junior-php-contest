<?php

namespace App\db\connection;

use PDO;

function createConnection(): PDO
{
    $dbPath = __DIR__ . '/../../db.sqlite';
    touch($dbPath);

    $db = null;

    //TODO: Create connection to Sqlite DB

    $db = new PDO("sqlite:db.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
}
