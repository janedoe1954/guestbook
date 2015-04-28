<?php

class Model_Post extends Framework_Model
{
    public function getQuantity()
    {
        $statement = $this->prepare("SELECT COUNT(*) AS quantity
                                     FROM posts");

        $statement->execute();
        $row = $statement->fetch();

        return $row['quantity'];
    }

    public function getAllPaginated($page)
    {
        $limit = $page * 10 - 10;

        $statement = $this->prepare("SELECT post_id, name, mail, message, created_at
                                     FROM posts
                                     ORDER BY created_at DESC
                                     LIMIT " . $limit . ",10");

        $statement->execute();
        return $statement->fetchAll();
    }

    public function get($postId)
    {
        $statement = $this->prepare("SELECT post_id, name, mail, message, created_at
                                     FROM posts
                                     WHERE post_id = :post_id
                                     LIMIT 1");

        $statement->bindValue(':post_id', $postId);

        $statement->execute();
        return $statement->fetch();
    }

    public function insert($data)
    {
        $statement = $this->prepare("INSERT INTO posts SET
                                     name = :name,
                                     mail = :mail,
                                     message = :message");

        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':mail', $data['mail']);
        $statement->bindValue(':message', $data['message']);

        return $statement->execute();
    }

    public function delete($postId)
    {
        $statement = $this->prepare("DELETE FROM posts
                                     WHERE post_id = :post_id
                                     LIMIT 1");

        $statement->bindValue(':post_id', $postId);
        return $statement->execute();
    }
}