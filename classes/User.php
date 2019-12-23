<?php

class User extends DataRecordModel
{
    public $id;
    public $role;
    public $login;
    public $password;
    public $name;
    public $surname;

    const MANAGER = 1;
    const EXECUTOR = 2;

    public function addUserFromForm($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        return $this;
    }
}