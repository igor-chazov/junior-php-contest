<?php

namespace App\Models;

class User extends ManagerDB
{
    public int $id;
    public string $email;
    public string $first_name;
    public string $last_name;
    public string $password;
    public $created_at;

    protected string $sqlInsert = "INSERT INTO users (email, first_name, last_name, password, created_at) 
VALUES (:email, :first_name, :last_name, :password, :created_at)";

    protected function getExecuteArr(): array
    {
        return [
            ':email' => $this->email,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':password' => $this->password,
            ':created_at' => $this->created_at,
        ];
    }

    protected function setExecuteFetch($arr): void
    {
        $this->id = $arr['id'];
        $this->email = $arr['email'];
        $this->first_name = $arr['first_name'];
        $this->last_name = $arr['last_name'];
        $this->password = $arr['password'];
        $this->created_at = $arr['created_at'];
    }
}
