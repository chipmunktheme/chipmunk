<?php

namespace Dashifen\Transformer\StorageTransformer;

use Dashifen\Transformer\TransformerInterface;
use Dashifen\Transformer\TransformerException;

interface StorageTransformerInterface extends TransformerInterface
{
    /**
     * canTransform
     *
     * Returns true if this object can transform data identified by the field
     * label based on the "direction" it's going, i.e. toward storage or toward
     * memory.
     *
     * @param string $field
     * @param bool   $forStorage
     *
     * @return bool
     */
    public function canTransform (string $field, bool $forStorage = true): bool;
    
    /**
     * canTransformForStorage
     *
     * This is a convenience method that calls canTransform passing a set flag
     * for the $forStorage argument.
     *
     * @param string $field
     *
     * @return bool
     */
    public function canTransformForStorage (string $field): bool;
    
    /**
     * canTransformFromStorage
     *
     * This is a convenience method that calls canTransform passing an unset
     * flag for the $forStorage argument.
     *
     * @param string $field
     *
     * @return bool
     */
    public function canTransformFromStorage (string $field): bool;
    
    /**
     * transform
     *
     * Passed the value through a transformation based on the field name.  This
     * transformation may be different based on whether we're transforming the
     * value for storage or retrieving it from storage.
     *
     * @param string $field
     * @param mixed  $value
     * @param bool   $forStorage
     * @param bool   $throw
     *
     * @return mixed
     * @throws TransformerException
     */
    public function transform (string $field, $value, bool $forStorage = true, bool $throw = false);
    
    /**
     * transformForStorage
     *
     * This is a convenience method that calls the transform() method passing a
     * set flag for the $forStorage argument.
     *
     * @param string $field
     * @param        $value
     *
     * @return mixed
     * @throws TransformerException
     */
    public function transformForStorage (string $field, $value);
    
    /**
     * transformFromStorage
     *
     * This is a convenience method that calls the transform() method passing
     * an unset flag for the $forStorage argument.
     *
     * @param string $field
     * @param        $value
     *
     * @return mixed
     * @throws TransformerException
     */
    public function transformFromStorage (string $field, $value);
    
    /**
     * transformArray
     *
     * Passes each value within an array through a transformation based on the
     * field name and whether we're transforming our value for storage or
     * retrieving it from storage.
     *
     * @param string $field
     * @param array  $values
     * @param bool   $forStorage
     * @param bool   $throw
     *
     * @return array
     * @throws TransformerException
     */
    public function transformArray (string $field, array $values, bool $forStorage = true, bool $throw = false): array;
    
    /**
     * transformArrayForStorage
     *
     * This is a convenience method that calls the transformArray() method
     * passing a set flag for the $forStorage argument.
     *
     * @param string $field
     * @param array  $values
     *
     * @return array
     * @throws TransformerException
     */
    public function transformArrayForStorage (string $field, array $values): array;
    
    /**
     * transformArrayFromStorage
     *
     * This is a convenience method that calls the transformArray() method
     * passing an unset flag for the $forStorage argument.
     *
     * @param string $field
     * @param array  $values
     *
     * @return array
     * @throws TransformerException
     */
    public function transformArrayFromStorage (string $field, array $values): array;
}
