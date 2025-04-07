<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function registerUser($user) {
        return $this->repository->registerUser($user);
    }

    public function checkUsernamePassword($username, $password) {
        return $this->repository->checkUsernamePassword($username, $password);
    }
    public function checkUsernameEmail($username, $email) {
        return $this->repository->checkUsernameEmail($username, $email);
    }
    function getAll()
    {
        return $this->repository->getAll();
    }

    function deleteUser($id)
    {
        return $this->repository->deleteUser($id);
    }
    function updateUser($data)
    {
        $this->repository->updateUser($data);
    }
    function getUser($id)
    {
        return $this->repository->getUser($id);
    }
    function addUser($data)
    {
        return $this->repository->addUser($data);
    }
}

?>