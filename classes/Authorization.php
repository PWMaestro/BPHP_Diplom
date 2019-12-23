<?php

class Authorization
{
    private $userRole;

    const ACCESS_IS_ALLOWED = User::MANAGER;
    const ACCESS_IS_DENIED = User::EXECUTOR;

    protected static $instance;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->userRole = $_SESSION['user']->role;
    }

    private function __clone()
    {
        throw new Error('Not cloneable...');
    }

    private function __wakeup()
    {
    }

    public static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function restrictAccessRights(bool $getAnswer = false)
    {
        if ($getAnswer) {
            return ($this->userRole === self::ACCESS_IS_ALLOWED)
                ? true
                : false;
        } else {
            if ($this->userRole !== self::ACCESS_IS_ALLOWED) {
                Router::start()->reload('?page=main', Config::get()->pathAdj);
            }
        }
    }
}
