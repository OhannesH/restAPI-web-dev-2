<?php

namespace Controllers;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Controller
{
    function respond($data)
    {
        $this->respondWithCode(200, $data);
    }

    function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

    private function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $object = new $className();
        foreach ($data as $key => $value) {
            if(is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }

    function checkForJwt() {
    // Check for token header
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->respondWithError(401, "No token provided");
            exit();  // Ensure further execution is stopped
        }

        // Read JWT from header
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        // Strip the part "Bearer " from the header
        $arr = explode(" ", $authHeader);
        
        if (count($arr) < 2) {
            $this->respondWithError(401, "Invalid token format");
            exit();
        }

        $jwt = $arr[1];

        // Secret key should be stored securely, for example, in an environment variable
        $secret_key = getenv('SECRET_KEY') ?: 'YOUR_SECRET_KEY';  // Load from environment

        if ($jwt) {
            try {
                // Decode JWT
                $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
                return $decoded;  // Return the decoded token
            } catch (Exception $e) {
                $this->respondWithError(401, $e->getMessage());
                exit();  // Ensure further execution is stopped
            }
        } else {
            $this->respondWithError(401, "Token not provided");
            exit();  // Ensure further execution is stopped
        }
    }
    function checkIfAdmin($decoded) {
        // Ensure the decoded token contains the `isAdmin` property in the correct place
        if (!isset($decoded->data->isAdmin) || !$decoded->data->isAdmin) {
            $this->respondWithError(403, "Access denied. Admins only.");
            exit();  // Ensure further execution is stopped
        }
        return true;
    }

}
