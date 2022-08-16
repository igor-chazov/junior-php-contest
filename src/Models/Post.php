<?php

namespace App\Models;

class Post extends ManagerDB
{
    public int $id;
    public string $title;
    public string $body;
    public $created_at;
    public int $creator_id;

    protected string $sqlInsert = "INSERT INTO post (title, body, created_at, creator_id) 
VALUES (:title, :body, :created_at, :creator_id)";

    protected function getExecuteArr(): array
    {
        return [
            ':title' => $this->title,
            ':body' => $this->body,
            ':created_at' => $this->created_at,
            ':creator_id' => $this->creator_id,
        ];
    }

    protected function setExecuteFetch($arr): void
    {
        $this->id = $arr['id'];
        $this->title = $arr['title'];
        $this->body = $arr['body'];
        $this->created_at = $arr['created_at'];
        $this->creator_id = $arr['creator_id'];
    }
}
