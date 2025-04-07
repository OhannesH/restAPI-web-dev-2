<?php

namespace Repositories;

use Models\Category;
use Models\Game;
use PDO;
use PDOException;
use Repositories\Repository;

class GameRepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT game.*, category.name as category_name FROM game INNER JOIN category ON game.category_id = category.id";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $games = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $games[] = $this->rowToGame($row);
            }

            return $games;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $query = "SELECT game.*, category.name as category_name FROM game INNER JOIN category ON game.category_id = category.id WHERE game.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $game = $this->rowToGame($row);

            return $game;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToGame($row) {
        $game = new Game();
        $game->id = $row['id'];
        $game->name = $row['name'];
        $game->description = $row['description'];
        $game->image = $row['image'];
        $game->category_id = $row['category_id'];
        $category = new Category();
        $category->id = $row['category_id'];
        $category->name = $row['category_name'];

        $game->category = $category;
        return $game;
    }

    function insert($game)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into game (name, description, image, category_id) VALUES (?,?,?,?,?)");

            $stmt->execute([$game->name, $game->description, $game->image, $game->category_id]);

            $game->id = $this->connection->lastInsertId();

            return $this->getOne($game->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($game, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE game SET name = ?, description = ?, image = ?, category_id = ? WHERE id = ?");

            $stmt->execute([$game->name, $game->description, $game->image, $game->category_id, $id]);

            return $this->getOne($game->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM game WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
