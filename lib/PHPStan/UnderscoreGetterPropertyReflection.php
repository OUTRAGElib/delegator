<?php


namespace OUTRAGElib\Delegator\PHPStan;

use \Exception;
use \PHPStan\Reflection\PropertyReflection as PHPStanPropertyReflection;
use \PHPStan\Reflection\ClassReflection as PHPStanClassReflection;
use \PHPStan\Type\Type as PHPStanType;
use \PHPStan\Type\MixedType as PHPStanMixedType;

class UnderscoreGetterPropertyReflection implements PHPStanPropertyReflection
{
	/**
	 *	Store PHPStan reflection object
	 */
	protected $reflection = null;
	
	
	/**
	 *	Store property name
	 */
	protected $property = null;
	
	
	/**
	 *	Called when constructing the property reflection
	 */
	public function __construct(PHPStanClassReflection $reflection, string $property)
	{
		$this->reflection = $reflection;
		$this->property = $property;
	}
	
	
	/**
	 *	What is the type? Uhm... if no type is defined, I guess we will have to define
	 *	it as mixed or something
	 *
	 *	@todo: figure out what exactly the return type will be - I guess we can do this
	 *	by doing loose inspections of the getter via some sort of intepretation of
	 *	the underscore getter?
	 */
	public function getType(): PHPStanType
	{
		return new PHPStanMixedType();
	}
	
	
	/**
	 *	What is the declaring class?
	 */
	public function getDeclaringClass(): PHPStanClassReflection
	{
		return $this->reflection;
	}
	
	
	/**
	 *	Is this property static? Never, it's a dynamic property
	 */
	public function isStatic(): bool
	{
		return false;
	}
	
	
	/**
	 *	Is this property private? Nope
	 */
	public function isPrivate(): bool
	{
		return false;
	}
	
	
	/**
	 *	Is this property public? Well, yeah, I guess??
	 */
	public function isPublic(): bool
	{
		return true;
	}
	
	
	/**
	 *	For the moment, we're going to presume that this property is indeed writable
	 */
	public function isWritable(): bool
	{
		return true;
	}
	
	
	/**
	 *	For the moment, we're going to presume that this property is indeed readable
	 */
	public function isReadable(): bool
	{
		return true;
	}
}