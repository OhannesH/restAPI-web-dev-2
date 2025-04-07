<?php

namespace Repositories;

use Models\Category;
use Models\Message;
use Models\User;
use PDO;
use PDOException;
use Repositories\Repository;

class MessageRepository extends Repository
{
    function getAll($user_id)
    {
        try {
            $query = "SELECT message.*, sender.username as senderUsername, receiver.username as receiverUsername FROM message INNER JOIN user as sender ON message.sender_id = sender.id INNER JOIN user as receiver ON message.receiver_id = receiver.id WHERE message.sender_id = $user_id OR message.receiver_id = $user_id ORDER BY message.created_at DESC";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $messages = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $messages[] = $this->rowToGame($row);
            }

            return $messages;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $query = "SELECT message.*, sender.username as senderUsername, receiver.username as receiverUsername FROM message INNER JOIN user as sender ON message.sender_id = sender.id INNER JOIN user as receiver ON message.receiver_id = receiver.id WHERE message.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $message = $this->rowToGame($row);

            return $message;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToGame($row) {
        $message = new Message();
        $message->id = $row['id'];
        $message->sender_id = $row['sender_id'];
        $message->receiver_id = $row['receiver_id'];
        $message->message = $row['message'];
        $message->created_at = $row['created_at'];
        $message->is_read = $row['is_read'];
        $sender = new User();
        $sender->id = $row['sender_id'];
        $sender->username = $row['senderUsername'];
        $message->sender = $sender;
        $receiver = new User();
        $receiver->id = $row['receiver_id'];
        $receiver->username = $row['receiverUsername'];
        $message->receiver = $receiver;

        return $message;
    }

    function insert($message)
    {
        // check if sender and receiver are different users
        try {
            $stmt = $this->connection->prepare("INSERT into message (sender_id, receiver_id, message) VALUES (?,?,?)");

            $stmt->execute([$message->sender_id, $message->receiver_id, $message->message]);

            $message->id = $this->connection->lastInsertId();

            return $this->getOne($message->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($message, $id)
    {
        try {
            //future edit messaging fuction
            $stmt = $this->connection->prepare("UPDATE message SET sender_id = :sender_id, receiver_id = :receiver_id, message = :message, is_read = :is_read WHERE id = :id");
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM message WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
