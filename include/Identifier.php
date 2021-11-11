<?php

// Identifier.php
// Maurice Boendermaker
// 11/11/2021

declare(strict_types=1);
namespace GenericGoods;

class Identifier
{
	// Properties
	private string $id;

	// Methods
	// Constructor
	public function __construct($id)
	{
		$this->id = $id;
	}

	// Setters
	public function setId(string $id)
	{
		$this->id = $id;
	}

	// Getters
	public function getId() : string
	{
		return $this->id;
	}
}

?>