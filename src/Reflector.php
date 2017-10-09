<?php

namespace Unity\Reflector;

use ReflectionClass;

/**
* Class Reflector.
*
* @author Eleandro Duzentos <eleandro@inbox.ru>
*/
class Reflector
{
    /**
     * Makes a new ReflectionClass instance.
     *
     * @param object|string $class
     *
     * @return ReflectionClass
     */
   public function reflect($class)
   {
       return new ReflectionClass($class);
   }

   /**
    * Checks if a member is accessible.
    *
    * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
    *
    * @return bool
    */
   public function isAccessible($reflectionObject)
   {
       return $reflectionObject->isPublic();
   }

   /**
    * Makes a member accessible if its inaccessible.
    *
    * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
    */
   public function makeAccessibleIfNot($reflectionObject)
   {
       if (!$this->isAccessible($reflectionObject)) {
           $this->makeAccessible($reflectionObject);
       }
   }

   /**
    * Makes a member accessible.
    *
    * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
    */
   public function makeAccessible($reflectionObject)
   {
       $reflectionObject->setAccessible(true);
   }

   /**
    * Checks if `$reflectedClass` has required params on constructor.
    *
    * @param ReflectionClass $reflectedClass
    *
    * @return bool
    */
   public function hasRequiredParams(ReflectionClass $reflectedClass)
   {
       if ($this->hasConstructor($reflectedClass)) {
           $constructor = $reflectedClass->getConstructor();

           return $constructor->getNumberOfRequiredParameters() > 0;
       }

       return false;
   }

   /**
    * Checks if `$reflectedClass` has constructor.
    *
    * @param ReflectionClass $reflectedClass
    *
    * @return bool
    */
   public function hasConstructor(ReflectionClass $reflectedClass)
   {
       return !is_null($reflectedClass->getConstructor());
   }

   /**
    * Gets constructor parameters in `$reflectedClass`.
    *
    * @param ReflectionClass $reflectedClass
    *
    * @return ReflectionParameter[]
    */
   public function getConstructorParameters(ReflectionClass $reflectedClass)
   {
       return $reflectedClass->getConstructor()->getParameters();
   }
}
