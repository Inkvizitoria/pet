<?php


namespace API\Model;

use System\Model\Model;

class SignInModel extends Model
{
    public function getCountry() {
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

    public function setFName() {
        return $this->query('country');
    }
    public function setLName() {
        return $this->getAll('country');
    }
    public function setCountry() {
        return $this->getAll('country');
    }
    public function setGender() {
        return $this->getAll('country');
    }
    public function setEmail() {
        return $this->getAll('country');
    }
    public function setPassword() {
        return $this->getAll('country');
    }
    public function setAvatar() {
        return $this->getAll('country');
    }
}