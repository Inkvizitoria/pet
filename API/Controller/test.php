<?php

namespace API\Controller;
use API\Controller;
use Smarty;
use API\Model\testModel;

class test extends Controller
{
    public function default()
    {
        echo "Hello world";
        var_dump($this->request);
    }

    public function test()
    {
        $textEmail = [];
        $smarty = new Smarty();
        $get = new testModel();
        $title = 'Тестируем говно!';
        //$text  = $get->getAll("test_table")
        $text2 = $get->getOne(22, "test_table");
        $text3 = $get->getColumn('password', "test_table");
        $text4 = $get->getOneColumn(22,'email', "test_table");
        $time = microtime();
        $textEmail = array('text' => array_slice($text3,10000), 'title' => $title, 'text3' => $text4);
        $smarty->assign('Email', $textEmail);
        $smarty->display('API/Template/test.tpl');
        var_dump( microtime() - $time);
    }
}
