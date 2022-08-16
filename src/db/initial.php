<?php

namespace App\db\initial;

use PDOException;

function initializeDb($db): void
{
    //TODO: Create initial tables

    $sqlCreateTables = [
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email VARCHAR(150) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            password VARCHAR(150) NOT NULL,
            created_at INTEGER NOT NULL
            )',
        'CREATE TABLE IF NOT EXISTS post (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title VARCHAR(255) NOT NULL,
            body TEXT,
            created_at INTEGER NOT NULL,
            creator_id INTEGER,
            FOREIGN KEY (creator_id) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE NO ACTION
            )'
    ];

    try {
        foreach ($sqlCreateTables as $sqlCreateTable) {
            $db->exec($sqlCreateTable);
        }
        echo "Success!\n";
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
