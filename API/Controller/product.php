<?php 

namespace API\Controller;

use API\Controller;
use API\Model\productModel;

class product extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new productModel();

    }

    public function create()
	{
        return $this->model->create('product', $this->request->post);
	}

    public function read()
    {
        return $this->model->read($this->request->post['id']);
    }

    public function update()
    {
        $id = $this->request->post['id'];
        unset($this->request->post['id']);

        return $this->model->update('product', $id, $this->request->post);
    }

    public function delete()
    {
        return $this->model->delete('product', $this->request->post['id']);
    }
}