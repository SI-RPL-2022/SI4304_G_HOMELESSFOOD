<?php

namespace Illuminate\Support\Facades;

/**
 * @method static \Illuminate\Contracts\Validation\Validator make(array $data, array $rules, array $messages = [], array $customAttributes = [])
<<<<<<< HEAD
 * @method static void excludeUnvalidatedArrayKeys()
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
 * @method static void extend(string $rule, \Closure|string $extension, string $message = null)
 * @method static void extendImplicit(string $rule, \Closure|string $extension, string $message = null)
 * @method static void replacer(string $rule, \Closure|string $replacer)
 * @method static array validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
 *
 * @see \Illuminate\Validation\Factory
 */
class Validator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'validator';
    }
}
