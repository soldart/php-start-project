<?php 

class Db
{
    public static function getConnection()
    {
		// $host = 'localhost';
		// $dbname = 'mvs_site';
		// $user = 'metrag_db';
		// $password = 'P3mGmTcl';
		// $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);

		$paramsPath = ROOT.'/config/db_params.php';
		$params = include($paramsPath);

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$db = new PDO($dsn, $params['user'], $params['password']);
		$db->exec("set names utf8");

		return $db;
    }
}