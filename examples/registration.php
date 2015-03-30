<?php
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes.php';
$user = new User("test@test.com", "good_password");
$parse= new \Chencha\Processes\Parse();
$data = json_decode(file_get_contents('process.json'),1);
$parse->run($user,$data);

