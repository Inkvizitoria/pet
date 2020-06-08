<?php


namespace API;


class Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = new \stdClass();
        $this->request->get = $_GET;
        $this->request->post = $_POST;
        if ($_SERVER['HTTP_CONTENT_TYPE'] === 'application/json') {
            $json = file_get_contents('php://input');
            $json = json_decode($json);
            $this->request->post = array_merge($this->request->post, (array)$json);
        }

        $this->request->headers = [];
        foreach ($_SERVER as $name => $value) {
            $startString = substr($name, 0, 4);
            if ($startString === 'HTTP') {
                $name = explode("_", $name)[1];
                $this->request->headers[$name] = $value;
            }
        }

        $this->request->session =& $_SESSION;
    }
}
