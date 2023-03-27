<?php

declare(strict_types=1);

namespace Kenny1911\Hydrator\Test;

use Kenny1911\Hydrator\SimpleReflectionHydrator;
use Kenny1911\Hydrator\Test\Stub\Simple;
use PHPUnit\Framework\TestCase;
use ReflectionException;

final class SimpleReflectionHydratorTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testHydrate()
    {
        $hydrator = new SimpleReflectionHydrator([
            'foo' => 'public',
            'bar' => 'protected',
            'baz' => 'private',
        ]);

        $simple = $hydrator->hydrate(
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
                'baz' => 'BAZ',
                'qux' => 'QUX',
            ],
            Simple::class
        );

        $this->assertSame('FOO', $simple->public);
        $this->assertSame('BAR', $simple->getProtected());
        $this->assertSame('BAZ', $simple->getPrivate());
    }

    /**
     * @throws ReflectionException
     */
    public function testHydratePartial()
    {
        $hydrator = new SimpleReflectionHydrator([
            'foo' => 'public',
            'bar' => 'protected',
            'baz' => 'private',
        ]);

        $simple = $hydrator->hydrate(
            [
                'bar' => 'BAR',
                'baz' => 'BAZ',
            ],
            Simple::class
        );

        $this->assertNull($simple->public);
        $this->assertSame('BAR', $simple->getProtected());
        $this->assertSame('BAZ', $simple->getPrivate());
    }

    /**
     * @throws ReflectionException
     */
    public function testHydrateMappingPartial()
    {
        $hydrator = new SimpleReflectionHydrator([
            'bar' => 'protected',
            'baz' => 'private',
        ]);

        $simple = $hydrator->hydrate(
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
                'baz' => 'BAZ',
                'qux' => 'QUX',
            ],
            Simple::class
        );

        $this->assertNull($simple->public);
        $this->assertSame('BAR', $simple->getProtected());
        $this->assertSame('BAZ', $simple->getPrivate());
    }
}
