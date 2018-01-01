<?php


namespace OUTRAGElib\Delegator\PHPStan;

use \Exception;
use \PHPStan\Reflection\PropertiesClassReflectionExtension as PHPStanPropertiesClassReflectionExtension;
use \PHPStan\Reflection\ClassReflection as PHPStanClassReflection;
use \PHPStan\Reflection\PropertyReflection as PHPStanPropertyReflection;

class PropertyClassReflection implements PHPStanPropertiesClassReflectionExtension
{
	/**
	 *	Does this class (which is of type 'DelegatorTrait') have any given property?
	 */
	public function hasProperty(PHPStanClassReflection $reflection, string $property) : bool
	{
		$native = $reflection->getNativeReflection();
		
		if($native->hasMethod("getter_".$property))
			return true;
		
		return false;
	}
	
	
	/**
	 *	Retrieve the given property, if it does indeed exist
	 */
	public function getProperty(PHPStanClassReflection $reflection, string $property) : PHPStanPropertyReflection
	{
		$native = $reflection->getNativeReflection();
		
		if($native->hasMethod("getter_".$property))
			return $this->getUnderscoreGetter($reflection, $property);
		
		return null;
	}
	
	
	/**
	 *	Build an instance of PropertyReflection based on the underscore getter syntax (getter_x)
	 */
	protected function getUnderscoreGetter(PHPStanClassReflection $reflection, string $property)
	{
		return new UnderscoreGetterPropertyReflection($reflection, $property);
	}
}