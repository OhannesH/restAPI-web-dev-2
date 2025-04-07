<?php
namespace Models;

class User_game {

    public int $id;
    public string $user_id;
    public string $username;
    public string $game_id;
    public string $description;
    public User $user;
    public Game $game;
    
}

?>