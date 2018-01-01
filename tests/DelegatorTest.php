<?php


namespace OUTRAGElib\Delegator\Tests;

use \OUTRAGElib\Delegator\DelegatorTrait;
use \PHPUnit\Framework\TestCase;


class DelegatorTest extends TestCase
{
	/**
	 *	Test getting of delegators
	 */
	public function testDelegatorGet()
	{
		$object = new DelegatorTestModel();
		
		$this->assertEquals(0, $object->stack);
	}
	
	
	/**
	 *	Test setting of delegators
	 */
	public function testDelegatorSet()
	{
		$object = new DelegatorTestModel();
		$object->stack = 3;
		
		$this->assertEquals(3, $object->stack);
	}
	
	
	/**
	 *	Test incrementing of delegators
	 */
	public function testDelegatorIncrement()
	{
		$object = new DelegatorTestModel();
		$object->stack++;
		
		$this->assertEquals(1, $object->stack);
	}
	
	
	/**
	 *	Test incrementing of delegators
	 */
	public function testDelegatorDerivedIsset()
	{
		$object = new DelegatorTestModel();
		
		$this->assertTrue(isset($object->stack));
	}
	
	
	/**
	 *	Test incrementing of delegators
	 */
	public function testDelegatorDerivedUnset()
	{
		$object = new DelegatorTestModel();
		
		unset($object->stack);
		
		$this->assertFalse(isset($object->stack));
	}
}