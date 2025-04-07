<?php

namespace Repositories;

use Models\User;
use Models\User_game;
use Models\Game;
use PDO;
use PDOException;
use Repositories\Repository;

class User_gameRepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT user_game.id, user.username as username, user.id as user_id, user_game.description, game.name as game_name, game.id as game_id, game.image as game_image FROM user_game INNER JOIN game ON game.id = user_game.game_id INNER JOIN user ON user.id = user_game.user_id";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $user_games = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {               
                $user_games[] = $this->rowToUserGame($row);
            }

            return $user_games;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $query = "SELECT user_game.id, user.username as username, user.id as user_id, user_game.description, game.name as game_name, game.id as game_id, game.image as game_image FROM user_game INNER JOIN game ON game.id = user_game.game_id INNER JOIN user ON user.id = user_game.user_id WHERE game.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $user_game = $this->rowToUserGame($row);

            return $user_game;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToUserGame($row) {
        $user_game = new User_game();
        $user_game->id = $row['id'];
        $user_game->user_id = $row['user_id'];
        $user_game->username = $row['username'];
        $user_game->game_id = $row['game_id'];
        $user_game->description = $row['description'];
        $user = new User();
        $user->id = $row['user_id'];
        $user->username = $row['username'];
        $game = new Game();
        $game->id = $row['game_id'];
        $game->name = $row['game_name'];
        $game->image = $row['game_image'];

        $user_game->user = $user;
        $user_game->game = $game;
        return $user_game;
    }

    function insert($user_game)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into user_game (user_id, game_id, description) VALUES (?,?,?)");

            $stmt->execute([$user_game->user_id, $user_game->game_id, $user_game->description]);

            $user_game->id = $this->connection->lastInsertId();

            return $this->getOne($user_game->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($user_game, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE user_game SET user_id = ?, game_id = ?, description = ? WHERE id = ?");

            $stmt->execute([$user_game->user_id, $user_game->game_id, $user_game->description, $id]);

            return $this->getOne($user_game->id);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user_game WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
