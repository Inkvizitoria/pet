<?php


namespace API\Model;

use API\Model;

class SignUpModel extends Model
{
    public function getAllCountry() {
        return $this->getAll('country');
    }

    public function save_user($data){

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $this->query("INSERT INTO `user` 
                                (`id`, `fname`, `lname`, `email`, `password`, `gender`, `avatar`, `id_country`, `id_user_role`, `date_reg`) 
                                 VALUES 
                                (NULL, 
                                 \"" . $this->db->real_escape_string(($data['fname'])) . "\",
                                 \"" . $this->db->real_escape_string(($data['lname'])) . "\",
                                 \"" . $this->db->real_escape_string(($data['email'])) . "\",
                                 \"" . $this->db->real_escape_string(($data['password'])) . "\",
                                 \"" . (int) $data['gender'] . "\",
                                 \"" . $this->db->real_escape_string(("test")) . "\",
                                 \"" . (int) $data['country'] . "\",
                                 NULL,
                                 \"" . $this->db->real_escape_string(($data['date_reg'])) . "\"
                                )");

    }
}