<?php

declare(strict_types=1);

namespace Kenny1911\Hydrator;

use ReflectionClass;
use ReflectionException;

/**
 * Simple implementation of {@see Hydrator} interface, used Reflection Api for filling object properties.
 */
final class SimpleReflectionHydrator implements Hydrator
{
    /** @var array<array-key, string> */
    private $mapping;

    /**
     * @param array<array-key, string> $mapping
     */
    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @param array<array-key, mixed> $data
     * @param class-string<T> $class
     * @return T
     * @template T of object
     *
     * @throws ReflectionException
     */
    public function hydrate(array $data, string $class)
    {
        $object = (new ReflectionClass($class))->newInstanceWithoutConstructor();

        return $this->hydrateObject($data, $object);
    }

    /**
     * @param array<array-key, mixed> $data
     * @param T $object
     * @return T
     * @template T of object
     *
     * @throws ReflectionException
     */
    public function hydrateObject(array $data, $object)
    {
        $ref = new ReflectionClass($object);

        foreach ($this->mapping as $key => $propName) {
            if (!array_key_exists($key, $data)) {
                continue;
            }

            $ref->getProperty($propName)->setValue($object, $data[$key]);
        }

        return $object;
    }
}
