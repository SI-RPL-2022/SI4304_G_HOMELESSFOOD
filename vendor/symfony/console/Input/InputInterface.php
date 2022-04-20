<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * InputInterface is the interface implemented by all input classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface InputInterface
{
    /**
     * Returns the first argument from the raw parameters (not parsed).
     *
<<<<<<< HEAD
     * @return string|null
=======
     * @return string|null The value of the first argument or null otherwise
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getFirstArgument();

    /**
     * Returns true if the raw parameters (not parsed) contain a value.
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The values to look for in the raw parameters (can be an array)
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return bool true if the value is contained in the raw parameters
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function hasParameterOption($values, bool $onlyParams = false);

    /**
     * Returns the value of a raw option (not parsed).
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The value(s) to look for in the raw parameters (can be an array)
     * @param mixed        $default    The default value to return if no result is found
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
     * @return mixed The option value
     */
    public function getParameterOption($values, $default = false, bool $onlyParams = false);

    /**
     * Binds the current Input instance with the given arguments and options.
     *
     * @throws RuntimeException
     */
    public function bind(InputDefinition $definition);

    /**
     * Validates the input.
     *
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate();

    /**
     * Returns all the given arguments merged with the default values.
     *
     * @return array
     */
    public function getArguments();

    /**
     * Returns the argument value for a given argument name.
     *
     * @return string|string[]|null The argument value
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function getArgument(string $name);

    /**
     * Sets an argument value by name.
     *
<<<<<<< HEAD
     * @param mixed $value The argument value
=======
     * @param string|string[]|null $value The argument value
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, $value);

    /**
     * Returns true if an InputArgument object exists by name or position.
     *
<<<<<<< HEAD
     * @return bool
     */
    public function hasArgument(string $name);
=======
     * @param string|int $name The InputArgument name or position
     *
     * @return bool true if the InputArgument object exists, false otherwise
     */
    public function hasArgument($name);
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

    /**
     * Returns all the given options merged with the default values.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Returns the option value for a given option name.
     *
     * @return string|string[]|bool|null The option value
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function getOption(string $name);

    /**
     * Sets an option value by name.
     *
<<<<<<< HEAD
     * @param mixed $value The option value
=======
     * @param string|string[]|bool|null $value The option value
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, $value);

    /**
     * Returns true if an InputOption object exists by name.
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return bool true if the InputOption object exists, false otherwise
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function hasOption(string $name);

    /**
     * Is this input means interactive?
     *
     * @return bool
     */
    public function isInteractive();

    /**
     * Sets the input interactivity.
     */
    public function setInteractive(bool $interactive);
}
