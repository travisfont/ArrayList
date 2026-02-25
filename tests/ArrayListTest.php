<?php

namespace Qsl\Tests;

use Qsl\ArrayList;
use PHPUnit\Framework\TestCase;
use OutOfBoundsException;

class ArrayListTest extends TestCase
{
    public function testAddAndGetPositive(): void
    {
        $list = new ArrayList();
        $list->add('first');
        $list->add('second');

        $this->assertSame(2, $list->count());
        $this->assertSame('first', $list->get(0));
        $this->assertSame('second', $list->get(1));
    }

    public function testGetNegativeOutOfBounds(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a');
        $list->get(1); // Index 1 does not exist
    }

    public function testGetNegativeNegativeIndex(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a');
        $list->get(-1); // Invalid index
    }

    public function testRemoveByIndexPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $list->remove(1); // Removing 'b'
        $this->assertSame(2, $list->count());
        $this->assertSame('c', $list->get(1));
    }

    public function testRemoveByIndexNegativeOutOfBounds(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a', 'b', 'c');
        $list->remove(5); // Out of bounds should throw
    }

    public function testRemoveByElementPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c', 'b');
        $index = $list->indexOf('b');
        $list->remove($index);
        $this->assertSame(3, $list->count());
        $this->assertSame('c', $list->get(1)); // First 'b' is gone
    }

    public function testRemoveByElementNegativeNotFound(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a', 'b', 'c');
        $index = $list->indexOf('z'); // This throws the exception before we even get to remove()
        $list->remove($index);
    }

    public function testSetPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $oldValue = $list->set(1, 'z');

        $this->assertSame('b', $oldValue);
        $this->assertSame('z', $list->get(1));
    }

    public function testSetNegativeOutOfBounds(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a', 'b', 'c');
        $list->set(5, 'z'); // Out of bounds
    }

    public function testClearPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $this->assertFalse($list->isEmpty());
        $list->clear();
        $this->assertTrue($list->isEmpty());
        $this->assertSame(0, $list->count());
    }

    public function testIndexOfPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c', 'b');
        $this->assertSame(1, $list->indexOf('b'));
    }

    public function testIndexOfNegativeNotFound(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $list = new ArrayList('a', 'b', 'c');
        $list->indexOf('z');
    }

    public function testContainsPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $this->assertTrue($list->contains('b'));
    }

    public function testContainsNegativeNotFound(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $this->assertFalse($list->contains('z'));
    }

    public function testToStringPositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $this->assertSame('["a","b","c"]', $list->toString());
    }

    // toString() negative test involves invalid UTF-8 forcing JsonException, but mixed type limits what we can pass natively
    // for a simple string conversion. We skip negative testing for toString here to avoid complex mock structures.

    public function testHashCodePositive(): void
    {
        $list = new ArrayList('a', 'b', 'c');
        $expectedHash = crc32('["a","b","c"]');
        $this->assertSame($expectedHash, $list->hashCode());
    }

    public function testEqualsPositive(): void
    {
        $list1 = new ArrayList('a', 'b', 'c');
        $list2 = new ArrayList('a', 'b', 'c');

        $this->assertTrue($list1->equals($list2));
    }

    public function testEqualsNegativeMismatch(): void
    {
        $list1 = new ArrayList('a', 'b', 'c');
        $list3 = new ArrayList('a', 'b');

        $this->assertFalse($list1->equals($list3));
    }
}
