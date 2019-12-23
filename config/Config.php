<?php

class Config
{
	public $nav;
	public $path;
    public $pathAdj;
	public $title;
	public $styles;
	public $availableLang;

	protected static $instance;

	private function __construct($pathAdj)
	{
	    $this->pathAdj = $pathAdj;
        $preliminaryPath = array(
            'db' => 'database/',
            'classes' => 'classes/',
            'styles' => 'style/',
            'img' => 'img/',
            'icons' => 'styles/icons/',
            'modules' => 'modules/default/',
            'skins' => 'skins/default/'
        );
        $this->path = $this->createPath($preliminaryPath);
		$this->nav = array(
			'allowedPages' => ['login', 'main', 'new', 'edit', '404'],
			'defaultPage' => 'login',
			'notFoundPage' => '404'
		);
		$this->title = array(
			'login' => 'Вход',
			'main' => 'Главная',
			'new' => 'Создание нового задания',
			'edit' => 'Редактирование задания',
			'404' => 'Ошибка: страница не существует'
		);
		$this->styles = array(
			'index' => ['layout'],
			'login' => ['login', 'footer'],
			'main' => ['sidebar', 'main', 'task', 'footer'],
			'new' => ['new'],
			'edit' => ['new'],
			'404' => ['404']
		);
		$this->availableLang = array(
		    'RU' => 'Русский',
            'EN' => 'Английский',
            'DE' => 'Немецкий',
            'FR' => 'Французский',
            'IT' => 'Итальянский',
            'ES' => 'Испанский'
        );
	}

    private function createPath(array $path)
    {
        $result = [];
        foreach ($path as $item => $value) {
            $result[$item] = $this->pathAdj . $value;
        }
        return $result;
    }

	private function __clone()
	{
		throw new Error('Not cloneable..');
	}

	private function __wakeup()
	{
	}

	public static function get($pathAdjustment = '')
	{
		if (self::$instance === null) {
			self::$instance = new self($pathAdjustment);
		}
		return self::$instance;
	}
}
