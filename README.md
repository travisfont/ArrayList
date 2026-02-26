# QuickStartLibs ArrayList for PHP

A minimalistic, lightweight, strictly-typed PHP implementation of a dynamic list, inspired by Java's `ArrayList`.

This library gives you an object-oriented, strictly-typed API to manage arrays without directly relying on core PHP array functions. It features built-in exception handling (e.g. `OutOfBoundsException`) and strict positive/negative method validations for more robust applications.

---

## Installation

You can install this library via Composer.

```bash
composer require quickstartlibs/arraylist
```

## Usage

Using `ArrayList\ArrayList` is simple. You can instantiate it empty, or feed it initial mixed elements via the constructor.

```php
use ArrayList\ArrayList;

// Initialize an empty list
$list = new ArrayList();

// Initialize a list with pre-existing elements
$list = new ArrayList('apple', 'banana', 'cherry');
```

---

## Method Reference

The robust list of available methods provided by `ArrayList`, crafted for type-safety and exceptional control over arrays.

### Table of Contents
| Modification | Retrieval | Information |
| --- | --- | --- |
| [add()](#add) | [get()](#get) | [count()](#count) |
| [set()](#set) | [indexOf()](#indexof) | [isEmpty()](#isempty) |
| [remove()](#remove) | [contains()](#contains) |  |
| [clear()](#clear) | [toArray()](#toarray) |  |
|  | [toString()](#tostring) |  |
|  | [hashCode()](#hashcode) |  |
|  | [equals()](#equals) |  |

---

### Modification Methods

<h4 id="add"><code>add(mixed $element): void</code></h4>

Appends the specified element to the end of this list.

```php
$list = new ArrayList();
$list->add('first item');
$list->add(42);
```

<h4 id="set"><code>set(int $index, mixed $element): mixed</code></h4>

Replaces the element at the specified position with the new element. Returns the element that was previously at that position. 

> **Throws:** `OutOfBoundsException` if the index is out of range.

```php
$list = new ArrayList('a', 'b', 'c');
$oldValue = $list->set(1, 'z'); // $oldValue is 'b', list is now ['a', 'z', 'c']
```

<h4 id="remove"><code>remove(int $index | mixed $element): void</code></h4>

Removes the element at the specified position, or finds and removes the first occurrence of the specific string/primitive. 

> **Throws:** `OutOfBoundsException` if the index does not exist, or the element cannot be found.
> 
> **Note:** Handled dynamically by checking parameter types if extending, but native PHP requires index targeting from above unless otherwise defined. By default, finding elements requires indexing first.

```php
$list = new ArrayList('a', 'b', 'c');

// By Index
$list->remove(1); // 'b' is removed.

// By Element
$index = $list->indexOf('c'); 
$list->remove($index); // Removes 'c'
```

<h4 id="clear"><code>clear(): void</code></h4>

Removes all elements from the list, leaving it empty.

```php
$list = new ArrayList('a', 'b', 'c');
$list->clear(); // List is now empty
```

---

### Retrieval Methods

<h4 id="get"><code>get(int $index): mixed</code></h4>

Returns the element at the specified position. 

> **Throws:** `OutOfBoundsException` if the index doesn't exist.

```php
$list = new ArrayList('a', 'b', 'c');
echo $list->get(0); // Outputs 'a'
```

<h4 id="indexof"><code>indexOf(mixed $element): int</code></h4>

Searches for the first occurrence of the given argument, returning its index. 

> **Throws:** `OutOfBoundsException` if the element cannot be found.

```php
$list = new ArrayList('apple', 'banana', 'apple');
echo $list->indexOf('banana'); // Outputs 1
```

<h4 id="contains"><code>contains(mixed $element): bool</code></h4>

Returns `true` if this list contains the specified element, `false` otherwise.

```php
$list = new ArrayList('a', 'b', 'c');
$list->contains('b'); // true
$list->contains('z'); // false
```

<h4 id="toarray"><code>toArray(): array</code></h4>

Returns a standard PHP array containing all of the elements in this list in their proper sequence.

```php
$list = new ArrayList('a', 'b');
$array = $list->toArray(); // ['a', 'b']
```

<h4 id="tostring"><code>toString(): string</code></h4>

Returns a JSON-encoded string representation of this collection. 

> **Throws:** `JsonException` on formatting failure.

```php
$list = new ArrayList('a', 'b');
echo $list->toString(); // Outputs '["a","b"]'
```

<h4 id="hashcode"><code>hashCode(): int</code></h4>

Returns the `crc32` hash code value for this list based on its JSON representation.

```php
$list = new ArrayList('a', 'b');
echo $list->hashCode(); // Outputs the integer crc32 hash of '["a","b"]'
```

<h4 id="equals"><code>equals(ArrayList $other): bool</code></h4>

Compares this list with the specified `ArrayList` object for equality. Returns `true` only if both objects identically match in length and sequence.

```php
$list1 = new ArrayList('a', 'b');
$list2 = new ArrayList('a', 'b');
$list3 = new ArrayList('a', 'c');

$list1->equals($list2); // true
$list1->equals($list3); // false
```

---

### Information Methods

<h4 id="count"><code>count(): int</code></h4>

Returns the total number of elements currently inside the list.

```php
$list = new ArrayList('a', 'b');
echo $list->count(); // Outputs 2
```

<h4 id="isempty"><code>isEmpty(): bool</code></h4>

Tests if this list has no elements.

```php
$list = new ArrayList();
$list->isEmpty(); // true
```