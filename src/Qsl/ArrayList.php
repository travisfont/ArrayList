<?php

namespace Qsl;

class ArrayList
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