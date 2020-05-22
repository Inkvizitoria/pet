<?php 

namespace API\Controller;

use API\Model\SignInModel;
use Smarty;

class SignIn
{
	public function default($data = null)
	{
        $smarty = new Smarty();

        $smarty->assign('error', $data ? $data : null);
        $smarty->assign('title', 'Sign In');
        $smarty->assign('site', 'Lorem Ipsum');
        $smarty->display('API/Template/header.tpl');
        $smarty->display('API/Template/signin.tpl');
        $smarty->display('API/Template/footer.tpl');
	}

    public function login(){
	    $inputData = $_POST;
	    $get = new SignInModel();

	    $data = $get->getFieldByValue($inputData['email'], 'email', 'email`, `password', 'user');

        if(empty($data[0]['email'])) {
            $json['error']['login'] = "Check email or password what you input.";
        } else {
            if(password_verify($inputData['password'], $data[0]['password'])){
                echo "Ты не ошибся дверью, fucking slave";
            } else {
                $json['error']['login'] = "Check email or password what you input.";
            }
        }
        if(!$json['error']) {
            echo "Ты не ошибся дверью, fucking slave";
        } else {
            return $this->default($json['error']);
        }
    }
}