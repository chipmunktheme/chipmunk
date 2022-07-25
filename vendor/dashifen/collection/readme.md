# Dashifen/Collection

An abstract object from which concrete collections can be built.

## Installation

`composer require dashifen/collection`

## Usage

Included herein is an abstract class, `AbstractCollection` which implements 
a `CollectionInterface`.  That interface extends both `Iterator` and 
`ArrayAccess`, the methods of which are implemented by `AbstractCollection`. 
Thus, extending this object for your own purposes will allow you to create your
own collection that responds like an array within `foreach` loops and can be 
accessed using the `[]` operator.

### Example

While the `AbstractCollection` object implements all of the methods of its 
interface, it may be beneficial to override some of them in order to type hint
parameters and return values throughout.  In the following example, we assume
a `Movie` object has been defined and that the indices within our collection
of movies are their titles, i.e. the collection is an associative array.

```php
class MovieCollection implements AbstractCollection 
{
    public function current(): Movie 
    {
        return current($this->collection);
    }

    public function key(): ?string 
    {
        return key($this->collection);
    }

    public function valid(): bool 
    {
        return is_string($this->key());
    }

    public function offsetGet ($offset): ?Movie
    {
        return $this->collection[$offset] ?? null;
    }

    public function offsetSet ($offset, $value): void
    {
        if (!($value instanceof Movie)) {
            throw new Exception('Collection value must be a Movie');
        }

        $this->collection[$offset] = $value;
    }
}
```
