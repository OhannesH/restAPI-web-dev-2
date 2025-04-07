<?php
namespace Services;

use Repositories\MessageRepository;

class MessageService {

    private $repository;

    function __construct()
    {
        $this->repository = new MessageRepository();
    }

    public function getAll($user_id) {
        return $this->repository->getAll($user_id);
    }

    public function getOne($id) {
        return $this->repository->getOne($id);
    }

    public function insert($item) {       
        return $this->repository->insert($item);        
    }

    public function update($item, $id) {       
        return $this->repository->update($item, $id);        
    }

    public function delete($item) {       
        return $this->repository->delete($item);        
    }
}

?>