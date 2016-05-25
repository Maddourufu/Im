<?php

class Model
{
	public static $db = null;
	
	
	public function getConnection()
	{
		$config = $_SESSION['config'];
		
		// Подключение к базе
		$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['base']}";
		self::$db = new PDO($dsn, $config['db']['user'], $config['db']['password']);
		self::$db->exec('SET NAMES utf8');
		return self::$db;