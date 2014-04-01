<?php

/**
 * Description of User
 *
 * @author artem
 */
namespace Users\Model;

class Users {
    public $id;
    public $name;
    public $email;
    public $password;
    
    public function setPassword($password) {
        $this->password = md5($password);
    }
    
    public function exchangeArray($data) {
        $this->name = (isset($data['name']) ? $data['name'] : NULL);
        $this->email = (isset($data['email']) ? $data['email'] : NULL);
        if (isset($data['password'])) {
            $this->setPassword($data["password"]);
        }
    }
}
