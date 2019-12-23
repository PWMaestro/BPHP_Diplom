<?php

class Router
{
	public $address;
	public $page;
	public $logout = false;
	protected static $instance;

	private function __construct()
	{
		if (!isset($_GET['page'])) {
			$_GET['page'] = Config::get()->nav['defaultPage'];
		} elseif (!in_array($_GET['page'], Config::get()->nav['allowedPages'])) {
			$_GET['page'] = Config::get()->nav['notFoundPage'];
		}
		$this->page = $_GET['page'];
		$this->address = Config::get()->path['modules'] . $_GET['page'] . '.php';
		if (isset($_GET['logout'])) {
		    $this->logout = true;
        }
	}

	private function __clone()
	{
		throw new Error('Not cloneable..');
	}

	private function __wakeup()
	{
	}

	public static function start()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function redirect($path = 0)
	{
		if ($path === 0) {
			require $this->address;
		} else {
            require $path;
		}
	}

	public function reload($parameter = '', $pathAdj = '')
    {
	    header("Location:" . $pathAdj . "index.php" . $parameter);
	    exit();
    }
}
