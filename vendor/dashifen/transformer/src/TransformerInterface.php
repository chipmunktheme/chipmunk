<?php

namespace Dashifen\Transformer;

interface TransformerInterface
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
    public function canTransform (string $field): bool;
    
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
    public function transform (string $field, $value, bool $throw = false);
    
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
    public function transformArray (string $field, array $values, bool $throw = false): array;
}
