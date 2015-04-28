<?php

class Model_Comment extends Framework_Model
{
    public function insert($data)
    {
        $statement = $this->prepare("INSERT INTO comments SET
                                     name = :name,
                                     comment = :comment,
                                     post_id = :post_id");

        $statement->bindValue(':name', $data['name']);
        $statement->bindValue(':comment', $data['comment']);
        $statement->bindValue(':post_id', $data['post_id']);

        return $statement->execute();
    }

    public function getAll()
    {
        $statement = $this->prepare("SELECT name, comment, post_id
                                     FROM comments
                                     ORDER BY post_id DESC");

        $statement->execute();
        return $statement->fetchAll();
    }

    public function getByPostId($postId)
    {
        $statement = $this->prepare("SELECT name, comment
                                     FROM comments
                                     WHERE post_id = :post_id
                                     ORDER BY comment_id DESC");

        $statement->bindValue(':post_id', $postId);

        $statement->execute();
        return $statement->fetchAll();
    }
}