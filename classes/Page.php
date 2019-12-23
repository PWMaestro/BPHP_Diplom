<?php

class Page
{
	public $page;
	public $title;
	public $stylesList = '';
	
	public function __construct()
	{
		$this->page = Router::start()->page;
		$this->title = Config::get()->title[$this->page];
		foreach (Config::get()->styles[$this->page] as $fileName) {
			$this->stylesList .= '<link rel="stylesheet" href="' . Config::get()->path['styles'] . $fileName . '.css">' . "\n";
		}
	}

	public function loadView(string $page = '')
	{
		if ($page === '') {
			$page = $this->page;
		}
		require Config::get()->path['skins'] . $page . '.tpl';
	}
}
