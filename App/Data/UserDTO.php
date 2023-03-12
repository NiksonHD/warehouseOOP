<?php

namespace App\Data;

class UserDTO {

    private $id;
    private $username;
    private $password;
    private $role;
    

    public static function create(
            $username, $password,$id = null) {
        return (new UserDTO())
                ->setUsername($username)
                ->setPassword($password)
                
                ->setId($id);
    }
    public function getRole() {
        return $this->role;
    }

    public function setRole($role): UserDTO {
        $this->role = $role;
        return $this;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    

    public function setUsername($username): UserDTO {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password): UserDTO {
        $this->password = $password;
        return $this;
    }

   

}
