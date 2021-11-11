<?php

// MySQL.php
// Maurice Boendermaker
// 11/11/2021

declare(strict_types=1);
namespace GenericGoods;

class MySQL
{
	// Properties
	private $host;
	private $username;
	private $password;
	private $database;
	public $con;

	// Methods / Functions
	public function connect($setHost, $setUsername, $setPassword, $setDatabase) {

		$this->host = $setHost;
		$this->username = $setUsername;
		$this->password = $setPassword;
		$this->database = $setDatabase;

		$this->con = mysqli_connect($setHost, $setUsername, $setPassword, $setDatabase);
	}

	public function query($setQuery) {

		$query = mysqli_query($this->con, $setQuery);

		return $query;
	}

	public function fetch($rs) {

		$row = mysqli_fetch_assoc($rs);

		return $row;
	}
}

?>