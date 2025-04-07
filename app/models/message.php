<?php
namespace Models;

class Message {

    public int $id;
    public string $sender_id;
    public string $receiver_id;
    public string $message;
    public string $created_at;
    public bool $is_read;
    public User $sender;
    public User $receiver;
    
}

?>