<?php

class Users extends JsonDataArray
{
    private $usersList;

    public function __construct($dataModelName = null)
    {
        parent::__construct($dataModelName);
        $this->usersList = $this->newQuery()->getObjs(self::GET_WITH_GUID);
    }

    public function checkUser($user)
    {
        foreach ($this->usersList as $item => $value) {
            if ($user->login === $value->login && $user->password === $value->password) {
                return $item;
            }
        }
        return false;
    }

    public function getUserById($id)
    {
        foreach ($this->usersList as $guid => $obj) {
            if ($id === $guid) {
                return $obj;
            }
        }
        throw new Error("No user with id: $id");
    }
}
