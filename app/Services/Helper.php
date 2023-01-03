<?php

namespace App\Services;

class Helper
{
    /**
     * Invoke the @class directive.
     *
     * @param string               $name          Base class name
     * @param string[]|string|null $modifiers,... Class name modifiers
     *
     * @return string
     */
    public static function class(string $name, $modifiers = null): string
    {
        if (! is_string($name)) {
            return '';
        }

        $modifiers = array_slice(func_get_args(), 1);
        $classes   = [ $name ];

        foreach ($modifiers as $modifier) {
            if (! empty($modifier)) {
                if (is_array($modifier)) {
                    foreach ($modifier as $modifier) {
                        if (! empty($modifier)) {
                            $classes[] = $name . '--' . $modifier;
                        }
                    }
                } elseif (is_string($modifier)) {
                    $classes[] = $name . '--' . $modifier;
                }
            }
        }

        return implode(' ', $classes);
    }
}
