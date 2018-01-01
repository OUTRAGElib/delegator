<?php


namespace OUTRAGElib\Delegator\Tests;

use \Exception;
use \OUTRAGElib\Delegator\DelegatorTrait;


class DelegatorTestModel
{
	/**
	 *	Include the delegator trait
	 */
	use DelegatorTrait;
	
	
	/**
	 *	Store a variable for tests
	 */
	protected $stack = 0;
	
	
	/**
	 *	Get the storage variable
	 */
	public function getter_stack()
	{
		if(isset($this->stack))
			return $this->stack;
		
		return null;
	}
	
	
	/**
	 *	Set the storage variable
	 */
	public function setter_stack($value)
	{
		return $this->stack = $value;
	}
}