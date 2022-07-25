# Transformers

Here we define an interface for Transformers as well as an Abstract class from which concrete objects that transform data based on field names can be built.  The goal:  to standardize the way that Dash creates transformers in their work.

## Installation

`composer require dashifen/transformer`

## Usage

You can either extend the `AbstractTransformer` object or simply implement the `TransformerInterface` on your own.  The interface defines two methods:

1. `canTransform` - returns a Boolean value to tell the calling scope if data can be transformed based on a `$field` parameter.
2. `transform` - returns a transformed `$value` based on a `$field` parameter.

The `AbstractTransformer` implements both of these for you while requiring that you define a third method: a protected `getTransformationMethod` method.  It returns the name of another method that is assumed to be of the same object that can transform data labeled by `$field`.

## Example

In this example, we're assuming that the naming convention for the application's fields is to use kebab-case.     

```php
class Transformer extends AbstractTransformer {
    protected function getTransformationMethod(string $field): string {
      
        // to convert a kebab-case $field to a function name, we want to 
        // convert it to StudlyCaps.  so, first, we convert from kebab-case to 
        // camelCase and then we ucfirst() the camelCase string to make it 
        // studly.  finally, we add the word "transform."  Thus, a start-date
        // field becomes startDate, then StartDate, and finally we return 
        // transformStartDate.
  
        $camelCase = preg_replace_callback("/-([a-z])/", function (array $matches): string {
            return strtoupper($matches[1]);
        }, $field);
      
        return "transform" . ucfirst($camelCase);
    }

    private function transformStartDate(string $date): string {
      
        // we assume that $date has already been validated, so here we just
        // want to make sure it's in YYYY-MM-DD format.  strtotime() can help
        // with that!
  
        return date("Y-m-d", strtotime($date));
    }
}
```

The above little class represents a simple, concrete object based on the functionality of the `AbstractTransformer` found within this repo.  The abstract object's implementation of the `canTransform` and `transform` methods of our interface make sure that we use the `getTransformationMethod` to identify the name of a method that can transform data labeled by `$field` and then will call that method when we need it returning its result.