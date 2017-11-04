<?php

use PHPUnit\Framework\TestCase;
use Tests\Helpers\Star;
use Tests\Helpers\Yomi;
use Unity\Reflector\Reflector;

class ReflectorTest extends TestCase
{
    public function testReflect()
    {
        $this->assertInstanceOf(ReflectionClass::class, (new Reflector())->reflect(Yomi::class));
    }

    public function testIsAccessible()
    {
        $reflector = $this->getReflector();
        $reflectedMethod = $this->getReflectedMethod();
        $reflectedProperty = $this->getReflectedProperty();

        $this->assertFalse($reflector->isAccessible($reflectedMethod));
        $this->assertTrue($reflector->isAccessible($reflectedProperty));
    }

    public function testMakeAccessible()
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

    public function testMakeAccessibleIfNot()
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

    public function testHasRequiredParams()
    {
        $reflector = $this->getReflector();

        $reflectedClass = $this->getReflectedClass();
        $this->assertFalse($reflector->hasRequiredParams($reflectedClass));

        $reflectedClass = new ReflectionClass(Star::class);
        $this->assertTrue($reflector->hasRequiredParams($reflectedClass));
    }

    public function testHasConstructor()
    {
        $reflector = $this->getReflector();

        $reflectedClass = $this->getReflectedClass();
        $this->assertFalse($reflector->hasConstructor($reflectedClass));

        $reflectedClass = new ReflectionClass(Star::class);
        $this->assertTrue($reflector->hasConstructor($reflectedClass));
    }

    public function testGetConstructorParameters()
    {
        $reflector = $this->getReflector();

        $reflectedClass = new ReflectionClass(Star::class);

        $constructorParameters = $reflector->getConstructorParameters($reflectedClass);

        $this->assertCount(1, $constructorParameters);
        $this->assertInstanceOf(ReflectionParameter::class, reset($constructorParameters));
    }

    public function getReflectedClass()
    {
        return new ReflectionClass(Yomi::class);
    }

    public function getReflectedMethod()
    {
        $reflectedClass = $this->getReflectedClass();

        return $reflectedClass->getMethod('isNickName');
    }

    public function getReflectedProperty()
    {
        $reflectedClass = $this->getReflectedClass();

        return $reflectedClass->getProperty('name');
    }

    public function getReflector()
    {
        return new Reflector();
    }

    public function getYomi()
    {
        return new Yomi();
    }
}
