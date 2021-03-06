<?php 

namespace API\Controller;

use API\Controller;
use API\Model\SignUpModel;
use DateTime;
use Smarty;

class SignUp extends Controller
{
	public function default($data = null)
	{
        $smarty = new Smarty();
        $get = new SignUpModel();
        $smarty->assign('title', 'Registration');
        $smarty->assign('site', 'Lorem Ipsum');
        $smarty->assign('country', $get->getAllCountry());
        $smarty->display('API/Template/header.tpl');
        $smarty->display('API/Template/signup.tpl');
        $smarty->display('API/Template/footer.tpl');
	}

    public function save()
    {
        $get = new SignUpModel();

        $data = $this->request->post;
        $json = [];

        if (!preg_match("/[0-9a-z]+@[a-z]/", $data['email']))
            $json["error"]["email"]    = "Check your email address.<br>";

        if(strlen($data['password']) < 8 || 20 < strlen($data['password']))
            $json["error"]["password"] = "Password must contain at least 8 characters and no more than 20 characters.<br>";

        if(empty($data['country']))
            $json["error"]["country"] = "Choose your country.<br>";

        if (
            (strlen($data['fname']) < 3 || 20 < strlen($data['fname']))
                                        ||
            (strlen($data['lname']) < 3 || 20 < strlen($data['lname']))
           ) {
                $json["error"]["name"] = "Check your first name and last name. Must contain at least 3 characters and no more than 20 characters.<br>";
        }

        $getEmails = $get->getFieldByAll('email', 'user');

        foreach ($getEmails as $key => $item) {
            $getEmails[$key] = $item['email'];
        }

        if(in_array($data['email'], $getEmails)) {
            $json["error"]["exists"] = "User with this email already exists.<br>";
        }

        if(!array_key_exists('error', $json)) {
            $data['date_reg'] = (new \DateTime(date(DATE_RFC822)))->format('Y-m-d H:i:s');
            $get->save_user($data);
            $json["url"] = "signin";
        }

        echo json_encode($json);
    }
}