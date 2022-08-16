<?php

namespace App\Models;

use App\db\DB;
use Exception;
use PDO;

class ManagerDB
{
    /**
     * @throws Exception
     */
    public function save(): void
    {
        $pdo = DB::getInstance()->getConnection();

        date_default_timezone_set('Asia/Yekaterinburg');
        $this->created_at = date("Y-m-d H:i:s");

        $stmt = $pdo->prepare($this->sqlInsert);
        $stmt->execute($this->getExecuteArr());

        $this->id = $pdo->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public static function findOne(int | null $id = null)
    {
        $pdo = DB::getInstance()->getConnection();

        if (static::class === 'App\Models\User') {
            $table = 'users';
            $instance = new User();
        } else if (static::class === 'App\Models\Post') {
            $table = 'post';
            $instance = new Post();
        }

        if ($id === null) {
            $stmt = $pdo->query("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
        } else {
            $stmt = $pdo->query("SELECT * FROM $table WHERE id = $id");

            if (!$stmt->fetchAll()) {
                $stmt = $pdo->query("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
            }
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $instance->setExecuteFetch($row);

        return $instance;
    }
}
