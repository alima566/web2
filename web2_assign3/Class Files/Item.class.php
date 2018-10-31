<?php

// This is a sample Item class. 
// This class could be extended by individual applications.
class Item 
{
	
	// Item attributes are all protected:
	protected $id;
	protected $quantity;
	protected $frame;
	protected $glass;
	protected $matt;
	
	// Constructor populates the attributes:
	public function __construct ($id, $quantity, $frame, $glass, $matt)
	{
		$this -> id = $id;
		$this -> quantity = $quantity;
		$this -> frame = $frame;
		$this -> glass = $glass;
		$this -> matt = $matt;
	}
	
	// Method that returns the ID:
	public function getId ()
	{
		return $this -> id;
	}

	// Method that returns the quantity:
	public function getQuantity ()
	{
		return $this -> quantity;
	}

	// Method that returns the frame:
	public function getFrame () 
	{
		return $this -> frame;
	}
	
	public function getGlass () 
	{
		return $this -> glass;
	}
	
	public function getMatt () 
	{
		return $this -> matt;
	}
}