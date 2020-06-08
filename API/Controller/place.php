<?php 

namespace API\Controller;

use API\Controller;
use API\Model\placeModel;

class place extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new placeModel();

    }

    public function create()
    {
        return $this->model->create('place', $this->request->post);
    }

    public function read()
    {
        return $this->model->read($this->request->post['id']);
    }

    public function update()
    {
        $id = $this->request->post['id'];
        unset($this->request->post['id']);

        return $this->model->update('place', $id, $this->request->post);
    }

    public function delete()
    {
        return $this->model->delete('place', $this->request->post['id']);
    }
}