<?php

namespace App;

use App\Models\User;
use App\Models\Post;
use App\db\DB;

use Exception;
use JsonException;

class Api
{
    /**
     * @throws JsonException
     * @throws Exception
     * @throws Exception
     * @throws Exception
     */
    public function connection(): void
    {
        //TODO: Implement api: get user by id, create user

        header("Content-Type: application/json");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $url = $_SERVER['REQUEST_URI'];
            $parsUrl = explode('/', $url);
            $urlPath = array_slice($parsUrl, 1, 2);
            $urlPath = implode('/', $urlPath);
            $prefix = isset($parsUrl[3]) ? '/' : '';

            if ($urlPath . $prefix !== 'api/users/') {
               exit;
            }

            $userId = null;

            if (isset($parsUrl[3])) {
                $userId = (int) $parsUrl[3];
            }

            $user = User::findOne($userId);
            $json = json_encode($user, JSON_THROW_ON_ERROR);
            echo $json;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $userData = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

            $user = new User();
            $user->email = $userData['email'];
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
            $user->password = $userData['password'];
            $user->save();

            $userId = User::findOne($user->id);
            $json = json_encode($userId, JSON_THROW_ON_ERROR);
            echo $json;
        }
    }
}
