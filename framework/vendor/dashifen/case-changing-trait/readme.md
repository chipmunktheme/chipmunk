# Case Changing Trait

This trait can be included to provide case changing capabilities within other
PHP packages.  Currently, the trait can covert between:

* [Kebab case](https://www.theserverside.com/definition/Kebab-case)
* [Camel case](https://en.wikipedia.org/wiki/Camel_case)
* [Snake case](https://en.wikipedia.org/wiki/Snake_case)
* [Pascal case](https://techterms.com/definition/pascalcase)

Furthermore, each of those can be turned into some sort of more 
"human-readable" style.  Thus, *kebab-case* would become *kebab case* or 
*Kebab Case* if you want it capitalized.

## Usage

Each of the cases listed above can be converted into the other ones.  Thus,
kebab case can be converted to camel, snake, and Pascal cases as well as the
human-readable format.  The names of the methods to do so are:

1. kebabToCamelCase
2. kebabToSnakeCase
3. kebabToPascalCase
4. kebabToReadableCase

Each of the other cases have a similar set of methods.  Wherever possible,
work performed by methods within the Trait were re-used to do this work.  So,
to convert from snake to camel case, we first convert to kebab-case and then
to camel case.  While this my spend a few more microseconds calling methods,
it almost eliminates repeated code.

## Studly Case?

There are a series of methods referencing studly case in the Trait that are
deprecated.  Dash originally though that studly case and Pascal case were the 
same, but has since learned that studly case usually refers to random or 
frequent capital letters as in "lOoK OuT fOr ThAt RoCk" used for ironic or 
comedic effect.  These methods should be avoided and will be removed in version
two.
