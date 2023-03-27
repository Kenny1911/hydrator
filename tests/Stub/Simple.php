<?php

declare(strict_types=1);

namespace Kenny1911\Hydrator\Test\Stub;

class Simple
{
    public $public;

    protected $protected;

    private $private;

    public function __construct($foo, $bar, $baz)
    {
        $this->public = $foo;
        $this->protected = $bar;
        $this->private = $baz;
    }

    public function getPublic()
    {
        return $this->public;
    }

    public function getProtected()
    {
        return $this->protected;
    }

    public function getPrivate()
    {
        return $this->private;
    }
}
