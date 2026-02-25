<?php

declare(strict_types=1);

namespace Qsl;

use OutOfBoundsException;
use JsonException;

class ArrayList
{
    private array $_list;

    public function __construct(mixed ...$array)
    {
        $this->_list = $array;
    }

    /**
     * Appends the specified element to the end of this list.
     */
    public function add(mixed $element): void
    {
        $this->_list[] = $element;
    }


    /**
     * Removes the element at the specified position in this list.
     */
    public function remove(int $index): void
    {
        if ($index < 0 || $index >= count($this->_list)) {
            throw new OutOfBoundsException("Index: $index, Size: " . count($this->_list));
        }

        array_splice($this->_list, $index, 1);
    }


    /**
     * Replaces the element at the specified position in this list with the specified element.
     */
    public function set(int $index, mixed $element): mixed
    {
        if ($index < 0 || $index >= count($this->_list)) {
            throw new OutOfBoundsException("Index: $index, Size: " . count($this->_list));
        }

        $oldValue = $this->_list[$index];
        $this->_list[$index] = $element;
        return $oldValue;
    }

    /**
     * Removes all of the elements from this list.
     */
    public function clear(): void
    {
        $this->_list = [];
    }

    /**
     * Returns the element at the specified position in this list.
     */
    public function get(int $index): mixed
    {
        if ($index < 0 || $index >= count($this->_list)) {
            throw new OutOfBoundsException("Index: $index, Size: " . count($this->_list));
        }

        return $this->_list[$index];
    }

    /**
     * Returns the number of elements in this list.
     */
    public function count(): int
    {
        return count($this->_list);
    }

    /**
     * Returns the index of the first occurrence of the specified element in this list.
     * Throws OutOfBoundsException if the list does not contain the element.
     */
    public function indexOf(mixed $element): int
    {
        $index = array_search($element, $this->_list, true);
        if ($index === false) {
            throw new OutOfBoundsException("Element not found in list");
        }
        return $index;
    }

    /**
     * Tests if this list has no elements.
     */
    public function isEmpty(): bool
    {
        return empty($this->_list);
    }

    /**
     * Returns a PHP array containing all of the elements in this list.
     */
    public function toArray(): array
    {
        return $this->_list;
    }

    /**
     * Returns true if this list contains the specified element.
     */
    public function contains(mixed $element): bool
    {
        try {
            $this->indexOf($element);
            return true;
        } catch (OutOfBoundsException) {
            return false;
        }
    }

    /**
     * Returns a string representation of this collection.
     * @throws JsonException
     */
    public function toString(): string
    {
        return json_encode($this->_list, JSON_THROW_ON_ERROR);
    }

    /**
     * Returns the hash code value for this list.
     * @throws JsonException
     */
    public function hashCode(): int
    {
        return crc32($this->toString());
    }
    /**
     * Compares this list with the specified ArrayList for equality.
     */
    public function equals(ArrayList $other): bool
    {
        return $this->_list === $other->toArray();
    }
}
