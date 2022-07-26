<?php

namespace Dashifen\Repository;

/**
 * Class Repository
 *
 * @package Dashifen\Repository
 *
 * The default Repository implementation which allows read-only access to all
 * properties by returning an empty array via the getHiddenPropertyNames()
 * method.  As long as your Repository isn't hiding anything, you can just
 * extend this one.  It also assumes no default values (other than what might
 * be defined in an extension) and no required properties (unless using the
 * double-leading-underscore naming convention).
 */
class Repository extends AbstractRepository
{
  /**
   * getHiddenPropertyNames
   *
   * Returns an array of protected properties that shouldn't be returned by
   * the __get() method or an empty array if the should all have read access.
   *
   * @return array
   */
  protected function getHiddenPropertyNames(): array
  {
    return [];
  }
  
  /**
   * getCustomPropertyDefaults
   *
   * Intended as a way to provide for functional defaults (e.g. the current
   * date), extensions can override this function to return an array of
   * default values for properties.  that array should be indexed by property
   * names.
   *
   * @return array
   */
  protected function getCustomPropertyDefaults(): array
  {
    return [];
  }
  
  /**
   * getRequiredProperties
   *
   * Returns an array of property names that must be non-empty after
   * construction.
   *
   * @return array
   */
  protected function getRequiredProperties(): array
  {
    return [];
  }
}
