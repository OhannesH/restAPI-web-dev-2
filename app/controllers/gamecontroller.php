<?php

namespace Controllers;

use Exception;
use Services\GameService;

class GameController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new GameService();
    }

    public function getAll()
    {
        // ensure the JWT is valid and decoded

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $games = $this->service->getAll($offset, $limit);

        $this->respond($games);
    }

    public function getOne($id)
    {
        $game = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the game is not found in the DB
        if (!$game) {
            $this->respondWithError(404, "Game not found");
            return;
        }

        $this->respond($game);
    }

    public function create()
    {
        $decoded = $this->checkForJwt(); 
        if (!$this->checkIfAdmin($decoded)){
            return;

        }
        try {
            sleep(2);
            $game = $this->createObjectFromPostedJson("Models\\Game");
            $game = $this->service->insert($game);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($game);
    }

    public function update($id)
    {
        $decoded = $this->checkForJwt(); 
        if (!$this->checkIfAdmin($decoded)){
            return;

        }
        try {
            sleep(2);
            $game = $this->createObjectFromPostedJson("Models\\Game");
            $game = $this->service->update($game, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($game);
    }

    public function delete($id)
    {
        $decoded = $this->checkForJwt(); 
        if (!$this->checkIfAdmin($decoded)){
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
