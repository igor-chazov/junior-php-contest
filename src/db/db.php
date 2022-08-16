<?php

namespace App\db;

use Exception;
use RuntimeException;

class DB
{
    private static ?DB $instance = null;

    public static function getInstance(): DB
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    private $db;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new RuntimeException("Cannot unserialize a singleton class DB.");
    }

    public function setupConnection($db): void
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function getConnection()
    {
        if (!$this->db) {
            throw new RuntimeException("Connection is not setup");
        }

        return $this->db;
    }
}
