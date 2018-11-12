<?php

namespace Unity\Reflector\Contracts;

use ReflectionClass;

/**
 * Interface IReflector.
 *
 * @author Eleandro Duzentos <eleandro@inbox.ru>
 *
 * @link   https://github.com/e200/
 */
interface IReflector
{
    /**
     * Makes a new ReflectionClass instance.
     *
     * @param object|string $class
     *
     * @return ReflectionClass
     */
    public function reflect($class);

    /**
     * Checks if a member is accessible.
     *
     * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
     *
     * @return bool
     */
    public function isAccessible($reflectionObject);

    /**
     * Makes a member accessible if its inaccessible.
     *
     * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
     */
    public function makeAccessibleIfNot($reflectionObject);

    /**
     * Makes a member accessible.
     *
     * @param \ReflectionMethod|\ReflectionProperty $reflectionObject
     */
    public function makeAccessible($reflectionObject);

    /**
     * Checks if `$reflectedClass` has required params on constructor.
     *
     * @param ReflectionClass $reflectedClass
     *
     * @return bool
     */
    public function hasRequiredParams(ReflectionClass $reflectedClass);

    /**
     * Checks if `$reflectedClass` has constructor.
     *
     * @param ReflectionClass $reflectedClass
     *
     * @return bool
     */
    public function hasConstructor(ReflectionClass $reflectedClass);

    /**
     * Gets constructor parameters in `$reflectedClass`.
     *
     * @param ReflectionClass $reflectedClass
     *
     * @return ReflectionParameter[]
     */
    public function getConstructorParameters(ReflectionClass $reflectedClass);
}
