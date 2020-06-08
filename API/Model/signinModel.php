<?php


namespace API\Model;

use API\Model;

class SignInModel extends Model
{
    public function getCountry() {
        return $this->getAll('country');
    }


    public function session_save($data) {
        if($this->create("session",  ["random_hash" => $this->db->real_escape_string(($data['random_hash'])), "id_user" => $data['user_id']]))
            return true;
        else
            return false;

    }

    public function getSession(int $user_id) {
        $session = $this->getFieldByWhere(['id_user' => $user_id], ['id'] , 'session');

        return $session ? $session : false;
    }
}