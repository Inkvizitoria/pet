<?php


namespace API\Model;

use System\Model\Model;

class SignUpModel extends Model
{
    public function getAllCountry() {
        return $this->getAll('country');
    }

    public function registration($data){

        $this->query("INSERT INTO `user` 
                                (`id`, `fname`, `lname`, `country`, `gender`, `email`, `password`, `avatar`, `date_reg`) 
                                 VALUES 
                                (NULL, 
                                 \"" . $this->db->real_escape_string(($data['fname'])) . "\",
                                 \"" . $this->db->real_escape_string(($data['lname'])) . "\",
                                 \"" . (int) $data['country'] . "\",
                                 \"" . (int) $data['gender'] . "\",
                                 \"" . $this->db->real_escape_string(($data['email'])) . "\",
                                 \"" . $this->db->real_escape_string(($data['password'])) . "\",
                                 \"" . $this->db->real_escape_string(("test")) . "\",
                                 \"" . $this->db->real_escape_string(($data['date_reg'])) . "\")");

    }
}