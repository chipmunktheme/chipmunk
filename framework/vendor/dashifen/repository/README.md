# dashifen/repository

_Repository_ (noun): a place, building, or receptacle where things are or may be stored.

This package defines an object, `AbstractRepository`, that provides read-only access to its protected properties using `__get()`.  If there are protected properties that need to remain hidden from external scopes, you can specify a list that won't be returned in that way.

## Installation

`composer install dashifen/repository`

## Usage

There are two ways to go here:

1. Extend the `AbstractRepository` object.  
2. Extend the `Repository` object.

If you extend the abstract object, you'll be forced to implement three methods:  
1. getHiddenPropertyNames - returns an array of properties that should remain inaccessable via the arrow operator,
2. getCustomPropertyDefaults - sets more complex default values than can be set during property declaration,
3. getRequiredProperties - returns a list of properties that must have values after object instantiation. 

The `Repository` object has already implemented these methods; they each return empty arrays. 

## Construction

The constructor for a Repository takes an associative array of data such that the indices are the names of properties and the array values will be set as the values for the listed properties. If you write a setter, it'll be called with the values for validation purposes.

The constructor's array argument's indices can either be in the expected camel case for the object's properties or in kabob case as in HTML attributes.  Thus, an index of `start-date` would be "linked" to the `startDate` property. 

## Getters

Typically, because a Repository exposes protected properties, getting them with the arrow operator is the way to go.  But, if you want to transform the internal representation of a property for external scopes, you can define a getter for a property that performs a transformation and returns its results.  For example, converting a date from YYYY-MM-DD format into MM/DD/YYYY for display on-screen.

Getters must be in the form of `"get" . ucfirst($propertyName)`.  So, the `startDate` property would have a getter of `getStartDate()`.  Getters can, themselves, be protected if you want to hide them from external scopes and rely on the `__get()` implementation and the arrow operator for access. 

## Setters

Repositories do not implement `__set()`, so you have to write them yourself.  By default, the `AbstractRepository` object will use setters within it's `__construct()` method.  So, if you extend that object, you must create a setter for each of your properties that are expected to be used by that constructor, _i.e._ those properties referenced by the constructor's array parameter.

Like getters, they must be in the format of `"set" . ucfirst($propertyName)`.  Thus, the setter for `startDate` must be `setStartDate()`.  If you implement setters, they will be called from the Repository's constructor when it iterates over it's array argument.  Because they're called from the constructor, they can be protected or private to create an object with read-only properties after construction.

### Example

```php
class Foo extends AbstractRepository {
    protected $bar;
    protected $baz;
    protected $bing;
    
    protected function getHiddenPropertyNames(): array 
    {
        return ["baz"];
    }
    
    protected function getCustomPropertyDefaults(): array 
    {
        return ["bing" => strtotime('Y-m-d h:i:s')];
    }
    
    protected function getRequiredProperties(): array 
    {
        return ["bar"];
    }

    protected function setBar(string $bar): void 
    {
        $this->bar = $bar;   
    }
    
    protected function getBar(): string 
    {
        return ucfirst($this->bar);
    }
}

$foo = new Foo(["bar" => "apple"]);

echo $foo->bar;         // echos "Apple" because of the getBar() getter
echo $foo->baz;         // throws RepositoryException (baz is hidden)
echo $foo->bing;        // echos current timestamp (based on custom default value)

$oof = new Foo([]);     // throws RepositoryException (bar is required)
```

## Array-able

There is a `toArray` method for Repositories to extract property names and values for non-hidden properties of the object.

## JsonSerializable

Repositories implement the JsonSerializable interface.  Therefore, you can encode them and non-hidden protected properties will be included in the JSON string that action produces.

## Iterator

Repositories implement the Iterator interface.  This allows you to use them in a `foreach` loop.  Using the Foo object defined in our example above ...

```php
$foo = new Foo(['bar' => 'Hello, World!']);

foreach ($foo as $field => $value) {
    echo "$field: $value" . PHP_EOL;
}
```

... would produce ...

```text
bar: Hello, World!
bing: <timestamp>
```

... skipping the `baz` property because it's hidden.

## dashifen/container

This object is a new name for the old `dashifen/container` object.  To avoid any confusion relating to the shared name with the PSR-11 Container Interface, I've simply changed the name from container to repository.  All future work on this object will occur here.  If you're still using the old object, I'd recommend switching your code and using this one instead.
