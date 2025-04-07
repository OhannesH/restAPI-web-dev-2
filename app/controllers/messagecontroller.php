<?php

namespace Controllers;

use Exception;
use Services\MessageService;
use Controllers\Controller;

class MessageController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new MessageService();
    }

    public function getAll($user_id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }

        $offset = NULL;
        $limit = NULL;
        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $messages = $this->service->getAll($user_id);

        $this->respond($messages);
    }

    public function getOne($id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }      

        $message = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the message is not found in the DB
        if (!$message) {
            $this->respondWithError(404, "Message not found");
            return;
        }

        $this->respond($message);
    }

    public function create()
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }
        try {
            sleep(2);
            $message = $this->createObjectFromPostedJson("Models\\Message");
            if ($message->sender_id == $message->receiver_id) {
                $this->respondWithError(400, "Message sender and receiver cannot be the same user");
                return;
            }
            $message = $this->service->insert($message);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($message);
    }

    public function update($id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }
        try {
            sleep(2);
            $message = $this->createObjectFromPostedJson("Models\\Message");
            $message = $this->service->update($message, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($message);
    }

    public function delete($id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }
        try {
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}
