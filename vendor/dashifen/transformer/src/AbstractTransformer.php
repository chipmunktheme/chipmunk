<?php

namespace Dashifen\Transformer;

abstract class AbstractTransformer implements TransformerInterface
{
    /**
     * canTransform
     *
     * Returns true if this object can transform data identified by the field
     *
     * @param string $field
     *
     * @return bool
     */
    public function canTransform (string $field): bool
    {
        return method_exists($this, $this->getTransformationMethod($field));
    }
    
    
    /**
     * getTransformationMethod
     *
     * Returns the name of a method in this class that is used to validate
     * information labeled by $field.
     *
     * @param string $field
     *
     * @return string
     */
    abstract protected function getTransformationMethod (string $field): string;
    
    /**
     * transform
     *
     * Passed the value through a transformation based on the field name.
     *
     * @param string $field
     * @param mixed  $value
     * @param bool   $throw
     *
     * @return mixed
     * @throws TransformerException
     */
    public function transform (string $field, $value, bool $throw = false)
    {
        if ($this->canTransform($field)) {
            
            // if we can transform data that's labeled by our field, then we'll
            // pass that value through the identified method.  if $value is an
            // array, we can pass it over to the method below to transform each
            // of its values.
            
            return !is_array($value)
                ? $this->{$this->getTransformationMethod($field)}($value)
                : $this->transformArray($field, $value);
        }
        
        // otherwise, we return the original value unharmed or throw an
        // exception based on the value of our $throw parameter.  by default,
        // this allows us to call this method in a loop passing it each
        // field/value pair and only altering the ones for which we actually
        // have a transformation method.
        
        if ($throw) {
            throw new TransformerException(
                sprintf('Cannot transform %s', $field),
                TransformerException::UNKNOWN_TRANSFORMATION
            );
        }
        
        return $value;
    }
    
    /**
     * transformArray
     *
     * Passes each value within an array through a transformation based on the
     * field name.
     *
     * @param string $field
     * @param array  $values
     * @param bool   $throw
     *
     * @return array
     * @throws TransformerException
     */
    public function transformArray (string $field, array $values, bool $throw = false): array
    {
        
        // while it's likely that we're here because someone called the
        // transform method above, we'll want to be sure to double-check that
        // we can do so in case someone called this one directly.  then, if we
        // can do so, we can use array_map to apply our transformation to each
        // value within the array or the original values without alteration.
        
        if ($this->canTransform($field)){
            return array_map([$this, $this->getTransformationMethod($field)], $values);
        }
        
        if ($throw) {
            throw new TransformerException(
                sprintf('Cannot transform %s', $field),
                TransformerException::UNKNOWN_TRANSFORMATION
            );
        }
        
        return $values;
    }
}
