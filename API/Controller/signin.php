<?php 

namespace API\Controller;

use API\Controller;
use API\Model\SignInModel;
use Smarty;

class SignIn extends Controller
{
	public function default()
	{
        $smarty = new Smarty();

        $smarty->assign('title', 'Sign In');
        $smarty->assign('site', 'Lorem Ipsum');
        $smarty->display('API/Template/header.tpl');
        $smarty->display('API/Template/signin.tpl');
        $smarty->display('API/Template/footer.tpl');
	}

    public function signin(){
	    $inputData = $this->request->post;
	    $get = new SignInModel();
        $json = [];
	    $data = $get->getFieldByWhere(['email' => $inputData['email']], ['email', 'password', 'id'] , 'user');

	    if(empty($data['email'])) {
            $json['error'] = "Check email or password what you input.";
        }

        if(!password_verify($inputData['password'], $data['password'])) {
            $json['error'] = "Check email or password what you input.";
        }

        if(!$json['error']) {
            $session = $get->getSession($data['id']);

            if ($session == true) {
                $json['text'] = "You are logged";
            } else {
                $hash = bin2hex(random_bytes(15));
                $session = $get->session_save(['random_hash' => $hash, 'user_id' => $data['id']]);

                $_SESSION['secure'] = ['random_hash' => $hash, 'user_id' => $data['id']];
                $json['text'] = "Ты не ошибся дверью, fucking slave";
                $json["url"] = 'personal';
            }
        }

        echo json_encode($json);

    }
}