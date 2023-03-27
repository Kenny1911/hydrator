<?php

declare(strict_types=1);

namespace Kenny1911\Hydrator;

interface Hydrator
{
    /**
     * @param array<array-key, mixed> $data
     * @param class-string<T> $class
     * @return T
     * @template T of object
     */
    public function hydrate(array $data, string $class);

    /**
     * @param array<array-key, mixed> $data
     * @param T $object
     * @return T
     * @template T of object
     */
    public function hydrateObject(array $data, $object);
}
