<?php

namespace Qsl;

interface Cloneable
{
    public function add(int);
    public function delete(int); // remove(); // clear()
    public function contains(): bool;
    public function equals(); // Compares this object against the specified object.
    public function hashCode(); // Gets the hashcode.
    public function toString()(); // Converts the data set to a String.
}

class ArrayList implements Cloneable
{
    private array $_list;

    public function __construct(...$array)
    {
        $this->_list = $array;
    }

    public function count(): int
    {
        return count($this->_list);
    }

    public function isEmpty(): bool
    {
        return empty($this->_list);
    }

    public function toArray(): array
    {
        return $this->_list;
    }
}