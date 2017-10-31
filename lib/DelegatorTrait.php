<?php


namespace OUTRAGElib\Delegator;

use \ArrayAccess;
use \Exception;


trait DelegatorTrait
{
	/**
	 *	Handler method for accessing virtual properties.
	 */
	public function &__get($property)
	{
		$value = null;
		
		if(!empty($property))
		{
			$call = "getter_".$property;
			
			if(method_exists($this, $call))
				$value = $this->{$call}();
			elseif($this instanceof ArrayAccess)
				$value = $this->offsetGet($property);
		}
		
		return $value;
	}
	
	
	/**
	 *	Handler method for setting virtual properties.
	 */
	public function __set($property, $value)
	{
		if(!empty($property))
		{
			$call = "setter_".$property;
			
			if(method_exists($this, $call))
				return $this->{$call}($value);
			
			if($this instanceof ArrayAccess && $this->offsetExists($property))
				return $this->offsetSet($property, $value);
			
			return $this->{$property} = $value;
		}
		
		return false;
	}
	
	
	/**
	 *	Handler method for checking if virtual property is set.
	 */
	public function __isset($property)
	{
		if(!empty($property))
		{
			# generic isset check
			$call = "isset_".$property;
			
			if(method_exists($this, $call))
				return $this->{$call}();
			
			# now to see if the value is set?
			$call = "getter_".$property;
			
			if(method_exists($this, $call))
				return true;
			
			# are we messing about with fake arrays?
			if($this instanceof ArrayAccess)
				return $this->offsetExists($property);
		}
		
		return false;
	}
	
	
	/**
	 *	Handler method for removing virtual properties.
	 */
	public function __unset($property)
	{
		if(!empty($property))
		{
			$call = "unset_".$property;
			
			if(method_exists($this, $call))
				return $this->{$call}();
			
			if($this instanceof ArrayAccess)
				return $this->offsetUnset($property);
			
			unset($this->{$property});
		}
	}
}