<?php
/**
 *	Delegator trait - creating easier ways of complicating code beyond all belief.
 */


namespace OUTRAGElib\Delegator;


trait DelegatorTrait
{
	/**
	 *	Handler method for accessing virtual properties.
	 */
	public function &__get($property)
	{
		$return = null;
		$call = "getter_".$property;
		
		if(method_exists($this, $call))
			return $this->{$call}();
		
		return $this->{$property};
	}
	
	
	/**
	 *	Handler method for setting virtual properties.
	 */
	public function __set($property, $value)
	{
		$call = "setter_".$property;
		
		if(method_exists($this, $call))
			return $this->{$call}($value);
		
		return $this->{$property} = $value;
	}
	
	
	/**
	 *	Handler method for checking if virtual property is set.
	 */
	public function __isset($property)
	{
		$call = "isset_".$property;
		
		if(method_exists($this, $call))
			return $this->{$call}();
		
		return isset($this->{$property});
	}
	
	
	/**
	 *	Handler method for removing virtual properties.
	 */
	public function __unset($property)
	{
		$call = "unset_".$property;
		
		if(method_exists($this, $call))
			return $this->{$call}();
		
		unset($this->{$property});
	}
}