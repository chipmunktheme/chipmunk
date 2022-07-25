<?php

namespace Dashifen\CaseChangingTrait;

/**
 * Trait CaseChangingTrait
 *
 * Because we prefer kebab-case in some situations, camelCase in others,
 * StudlyCaps in still others, and we might even want a human readable format
 * somewhere, this trait encapsulates ways to convert strings between different
 * types of programming cases.  All parameters are assumed to be in kebab-case.
 *
 * @package Dashifen\WPHandler\Traits
 */
trait CaseChangingTrait
{
  /**
   * kebabToCamelCase
   *
   * Converts a kebab-case HTML attribute value into a camelCase string.
   * Thus, kebab-case becomes kebabCase.
   *
   * @param string $kebabCase
   *
   * @return string
   */
  protected function kebabToCamelCase(string $kebabCase): string
  {
    // to convert from kebab-case to camelCase we look for any letter
    // following a hyphen.  then, our callback function capitalizes it.
    
    $pattern = "/-([a-z])/";
    $function = fn ($matches) => strtoupper($matches[1]);
    return preg_replace_callback($pattern, $function, $kebabCase);
  }
  
  /**
   * kebabToSnakeCase
   *
   * Given a kebab-case string, converts it to snake_case by replacing hyphens
   * with underscores.
   *
   * @param string $kebabCase
   *
   * @return string
   */
  protected function kebabToSnakeCase(string $kebabCase): string
  {
    return str_replace('-', '_', $kebabCase);
  }
  
  /**
   * kebabToPascalCase
   *
   * Given a kebab-case string, converts it first to camelCase and then
   * uses ucfirst() to capitalize the first letter, too.  Thus, kebab-case
   * becomes KebabCase.
   *
   * @param string $kebabCase
   *
   * @return string
   */
  protected function kebabToPascalCase(string $kebabCase): string
  {
    return ucfirst($this->kebabToCamelCase($kebabCase));
  }
  
  /**
   * kebabToStudlyCase
   *
   * Given a kebab-case string, converts it first to camelCase and then
   * uses ucfirst() to capitalize the first letter, too.  Thus, kebab-case
   * becomes KebabCase.
   *
   * @param string $kebabCase
   *
   * @return string
   * @deprecated
   */
  protected function kebabToStudlyCase(string $kebabCase): string
  {
    return $this->kebabToPascalCase($kebabCase);
  }
  
  /**
   * kebabToReadableCase
   *
   * Turns a kebab-case string into a human readable one.  Thus, kebab-case
   * becomes Kebab Case or kebab case based on the state of the $capitalize
   * parameter.
   *
   * @param string $kebabCase
   * @param bool   $capitalize
   *
   * @return string
   */
  protected function kebabToReadableCase(string $kebabCase, bool $capitalize = true): string
  {
    $string = str_replace('-', ' ', $kebabCase);
    return $capitalize ? ucwords($string) : $string;
  }
  
  /**
   * camelToKebabCase
   *
   * Converts a camel case string into a kebab case one.  Thus, camelCase
   * becomes camel-case.
   *
   * @param string $camelCase
   *
   * @return string
   */
  protected function camelToKebabCase(string $camelCase): string
  {
    // to make this conversion, we want to convert a lowercase character
    // followed by a capital one to the same two lowercase characters
    // separated by a dash.  a regular expression can identify where we
    // want to make our replacement, and a callback function can handle
    // the rest by joining the lower case letter with a dash and the newly
    // lower case capital letter.
    
    $pattern = '/([a-z])([A-Z])/';
    $function = fn ($matches) => $matches[1] . '-' . strtolower($matches[2]);
    return preg_replace_callback($pattern, $function, $camelCase);
  }
  
  /**
   * camelToSnakeCase
   *
   * Given a camelCase string, converts it to snake_case by first converting
   * it to kebab-case.
   *
   * @param string $camelCase
   *
   * @return string
   */
  protected function camelToSnakeCase(string $camelCase): string
  {
    return $this->kebabToSnakeCase($this->camelToKebabCase($camelCase));
  }
  
  /**
   * camelToPascalCase
   *
   * Converts a camel case string to a pascal case one.  Thus, camelCase
   * becomes CamelCase.
   *
   * @param string $camelCase
   *
   * @return string
   */
  protected function camelToPascalCase(string $camelCase): string
  {
    return ucfirst($camelCase);
  }
  
  /**
   * camelToStudlyCase
   *
   * Converts a camel case string to a studly case one.  Thus, camelCase
   * becomes CamelCase.
   *
   * @param string $camelCase
   *
   * @return string
   * @deprecated
   */
  protected function camelToStudlyCase(string $camelCase): string
  {
    return $this->camelToPascalCase($camelCase);
  }
  
  /**
   * camelToReadableCase
   *
   * Converts a camel case string to a more human readable case.  Thus,
   * camelCase becomes Camel Case or camel case, with capitalization controlled
   * by the second parameter.
   *
   * @param string $camelCase
   * @param bool   $capitalize
   *
   * @return string
   */
  protected function camelToReadableCase(string $camelCase, bool $capitalize = true): string
  {
    return $this->kebabToReadableCase(
      $this->camelToKebabCase($camelCase),
      $capitalize
    );
  }
  
  /**
   * snakeToKebabCase
   *
   * Given a string in snake_case, converts it to kebab-case by replacing
   * underscores with hyphens.
   *
   * @param string $snakeCase
   *
   * @return string
   */
  protected function snakeToKebabCase(string $snakeCase): string
  {
    return str_replace('_', '-', $snakeCase);
  }
  
  /**
   * snakeToCamelCase
   *
   * Given a string in snake_case, converts it to camelCase by first converting
   * it to kebab-case.
   *
   * @param string $snakeCase
   *
   * @return string
   */
  protected function snakeToCamelCase(string $snakeCase): string
  {
    return $this->kebabToCamelCase($this->snakeToKebabCase($snakeCase));
  }
  
  /**
   * snakeToPascalCase
   *
   * Given a string in snake_case, converts it to PascalCase by first
   * converting it to camelCase and then capitalizing the first letter.
   *
   * @param string $snakeCase
   *
   * @return string
   */
  protected function snakeToPascalCase(string $snakeCase): string
  {
    return ucfirst($this->snakeToCamelCase($snakeCase));
  }
  
  /**
   * snakeToStudlyCase
   *
   * Given a string in snake_case, converts it to StudlyCase by first
   * converting it to camelCase and then capitalizing the first letter.
   *
   * @param string $snakeCase
   *
   * @return string
   * @deprecated
   */
  protected function snakeToStudlyCase(string $snakeCase): string
  {
    return $this->snakeToPascalCase($snakeCase);
  }
  
  /**
   * snakeToReadbleCase
   *
   * Converts a snake_case string to a human readable one by converting
   * underscores to spaces and then capitalizing the resulting words based on
   * the state of the $capitalize flag.
   *
   * @param string $snakeCase
   * @param bool   $capitalize
   *
   * @return string
   */
  protected function snakeToReadableCase(string $snakeCase, bool $capitalize = true): string
  {
    $words = str_replace('_', ' ', $snakeCase);
    return $capitalize ? ucwords($words) : $words;
  }
  
  /**
   * pascalToKebabCase
   *
   * Converts a PascalCaps string to a kebab-case one.  Thus, PascalCaps would
   * become pascal-caps instead.
   *
   * @param string $pascalCase
   *
   * @return string
   */
  protected function pascalToKebabCase(string $pascalCase): string
  {
    // first we convert PascalCase to camelCase and then we can convert from
    // camelCase to kebab-case.  all of this work is performed by other methods
    // of this trait as follows.
    
    return $this->camelToKebabCase($this->pascalToCamelCase($pascalCase));
  }
  
  /**
   * pascalCaseToCamelCase
   *
   * Given a PascalCase string, converts it to camelCase.
   *
   * @param string $pascalCase
   *
   * @return string
   */
  protected function pascalToCamelCase(string $pascalCase): string
  {
    // camelCase is the same as PascalCase except the first character is lower
    // case in the former and capitalized in the latter.  so, to go from pascal
    // to camel, we need to lower case the first letter of our parameter.  PHP
    // has a function for that:
    
    return lcfirst($pascalCase);
  }
  
  /**
   * pascalToSnakeCase
   *
   * Given a string in PascalCase, converts it to snake_case by first
   * converting it to camelCase.
   *
   * @param string $pascalCase
   *
   * @return string
   */
  protected function pascalToSnakeCase(string $pascalCase): string
  {
    return $this->camelToSnakeCase($this->pascalToCamelCase($pascalCase));
  }
  
  /**
   * pascalToReadableCase
   *
   * Turns a PascalCaps string into a more human readable format allowing for
   * both "Pascal Caps" and "pascal caps" based on the Boolean value of the
   * second parameter.
   *
   * @param string $pascalCase
   * @param bool   $capitalize
   *
   * @return string
   */
  protected function pascalToReadableCase(string $pascalCase, bool $capitalize = true): string
  {
    // first, we switch to camelCase and then from camelCase to our more
    // readable case both using other methods of this trait.  the
    // capitalization of our final case is based on the second parameter.
    
    return $this->camelToReadableCase(
      $this->pascalToCamelCase($pascalCase),
      $capitalize
    );
  }
  
  /**
   * studlyToKebabCase
   *
   * Converts a StudlyCaps string to a kebab-case one.  Thus, StudlyCaps would
   * become studly-caps instead.
   *
   * @param string $studlyCase
   *
   * @return string
   * @deprecated
   */
  protected function studlyToKebabCase(string $studlyCase): string
  {
    return $this->pascalToKebabCase($studlyCase);
  }
  
  /**
   * studlyCaseToCamelCase
   *
   * Given a StudlyCase string, converts it to camelCase.
   *
   * @param string $studlyCase
   *
   * @return string
   * @deprecated
   */
  protected function studlyToCamelCase(string $studlyCase): string
  {
    return $this->pascalToCamelCase($studlyCase);
  }
  
  /**
   * studlyToSnakeCase
   *
   * Given a string in StudlyCase, converts it to snake_case by first
   * converting it to camelCase.
   *
   * @param string $studlyCase
   *
   * @return string
   * @deprecated
   */
  protected function studlyToSnakeCase(string $studlyCase): string
  {
    return $this->pascalToSnakeCase($studlyCase);
  }
  
  /**
   * studlyToReadableCase
   *
   * Turns a StudlyCaps string into a more human readable format allowing for
   * both "Studly Caps" and "studly caps" based on the Boolean value of the
   * second parameter.
   *
   * @param string $studlyCase
   * @param bool   $capitalize
   *
   * @return string
   * @deprecated
   */
  protected function studlyToReadableCase(string $studlyCase, bool $capitalize = true): string
  {
    return $this->pascalToReadableCase($studlyCase, $capitalize);
  }
}
