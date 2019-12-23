<?php

/**
 *
 */
class Authentication
{
    public $loginFail = '';

    protected static $instance;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
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

    public function checkProtectedPage()
    {
        // Is there a request to delete session?
        if (Router::start()->logout) {
            $_SESSION = [];
            session_destroy();
        }
        // Was there a login to the page?
        if (!isset($_SESSION['user'])) {
            Router::start()->reload();
        }
    }

    public function checkEnterPage()
    {
        if (isset($_SESSION['user'])) {
            Router::start()->reload('?page=main');
        }
        if (isset($_POST['submit'])) {
            $users = new Users();
            $user = new User();
            $user->addUserFromForm($_POST['login'], $_POST['password']);
            if ($id = $users->checkUser($user)) {
                $_SESSION['user'] = $users->getUserById($id);
                Router::start()->reload('?page=main');
            } else {
                $this->loginFail = 'Неверный логин или пароль!';
            }
        }
    }
}