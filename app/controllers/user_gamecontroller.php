<?php

namespace Controllers;

use Exception;
use Services\User_gameService;

class User_gameController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new User_gameService();
    }

    public function getAll()
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

        $user_games = $this->service->getAll($offset, $limit);

        $this->respond($user_games);
    }

    public function getOne($id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return;
        }
        $user_game = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the user_game is not found in the DB
        if (!$user_game) {
            $this->respondWithError(404, "User_game not found");
            return;
        }

        $this->respond($user_game);
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
            $user_game = $this->createObjectFromPostedJson("Models\\User_game");
            $user_game = $this->service->insert($user_game);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($user_game);
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
            $user_game = $this->createObjectFromPostedJson("Models\\User_game");
            $user_game = $this->service->update($user_game, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($user_game);
    }

    public function delete($id)
    {
        // Check for JWT
        $decoded = $this->checkForJwt();
        if (!$this->checkIfAdmin($decoded)){
            return;

        }
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
