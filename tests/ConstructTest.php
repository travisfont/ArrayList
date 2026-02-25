<?php

namespace ArrayList\Tests;

use ArrayList\ArrayList;
use PHPUnit\Framework\TestCase;

class ConstructTest extends TestCase
{
    public function testBasicNewArrayList(): void
    {
        $expected = [21, 42, 64, 64];
        $actual = new ArrayList(21, 42, 64, 64);

        $this->assertSame($expected, $actual->toArray());
    }
}
