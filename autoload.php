<?php

spl_autoload_register(
	function($fileName) {
		include Config::get()->path['classes'] . $fileName . '.php';
	});
