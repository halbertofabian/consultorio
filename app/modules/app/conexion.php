<?php

class Conexion
{

	static public function conectar()
	{

		$link = new PDO(
			"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
			DB_USER,
			DB_PASSWORD
		);

		$link->exec("set names utf8");

		return $link;
	}

	static public function conectarBDProyecto($bd)
	{

		
		$link = new PDO(
			"mysql:host=" . DB_HOST . ";dbname=" . $bd['db_name'],
			$bd['user_name'],
			$bd['password_db']
		);

		$link->exec("set names utf8");

		return $link;
	}
}
