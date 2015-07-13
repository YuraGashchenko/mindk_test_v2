<?php
require 'ClassLoader.php';
	$loader           = new ClassLoader();
	$front_controller = $loader->get('FrontController');
	$front_controller->run();
