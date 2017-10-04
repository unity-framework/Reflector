<?php

use PHPUnit\Framework\TestCase;
use Unity\Reflector\Reflector;
use Tests\Helpers\Star;
use Tests\Helpers\Yomi;

class ReflectorTest extends TestCase
{
    function testReflect()
    {
        $this->assertInstanceOf(ReflectionClass::class, Reflector::reflect(Yomi::class));
    }

    function testIsAccessible()
    {
        $reflector = $this->getReflector();
        $reflectedMethod = $this->getReflectedMethod();
        $reflectedProperty = $this->getReflectedProperty();

        $this->assertFalse($reflector->isAccessible($reflectedMethod));
        $this->assertTrue($reflector->isAccessible($reflectedProperty));
    }

    function testMakeAccessible()
    {
        $reflector = $this->getReflector();
        $reflectedInaccessibleMethod = $this->getReflectedMethod();

        $reflector->makeAccessible($reflectedInaccessibleMethod);

        ////////////////////
        // It's necessary //
        ////////////////////
        $instance = $this->getYomi();

        $this->assertTrue($reflectedInaccessibleMethod->invoke($instance));
    }

    function testMakeAccessibleIfNot()
    {
        $reflector = $this->getReflector();
        $reflectedInaccessibleMethod = $this->getReflectedMethod();

        $reflector->makeAccessibleIfNot($reflectedInaccessibleMethod);

        ////////////////////
        // It's necessary //
        ////////////////////
        $instance = $this->getYomi();

        $this->assertTrue($reflectedInaccessibleMethod->invoke($instance));
    }

    function testHasRequiredParams()
    {
        $reflector = $this->getReflector();

        $reflectedClass = $this->getReflectedClass();
        $this->assertFalse($reflector->hasRequiredParams($reflectedClass));

        $reflectedClass = new ReflectionClass(Star::class);
        $this->assertTrue($reflector->hasRequiredParams($reflectedClass));
    }

    function testHasConstructor()
    {
        $reflector = $this->getReflector();

        $reflectedClass = $this->getReflectedClass();
        $this->assertFalse($reflector->hasConstructor($reflectedClass));

        $reflectedClass = new ReflectionClass(Star::class);
        $this->assertTrue($reflector->hasConstructor($reflectedClass));
    }

    function testGetConstructorParameters()
    {
        $reflector = $this->getReflector();

        $reflectedClass = new ReflectionClass(Star::class);

        $constructorParameters = $reflector->getConstructorParameters($reflectedClass);

        $this->assertCount(1, $constructorParameters);
        $this->assertInstanceOf(ReflectionParameter::class, reset($constructorParameters));
    }

    function getReflectedClass()
    {
        return new ReflectionClass(Yomi::class);
    }

    function getReflectedMethod()
    {
        $reflectedClass = $this->getReflectedClass();

        return $reflectedClass->getMethod('isNickName');
    }

    function getReflectedProperty()
    {
        $reflectedClass = $this->getReflectedClass();

        return $reflectedClass->getProperty('name');
    }

    function getReflector()
    {
        return new Reflector();
    }

    function getYomi()
    {
        return new Yomi();
    }
}
