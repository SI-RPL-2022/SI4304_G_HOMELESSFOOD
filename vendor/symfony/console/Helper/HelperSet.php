<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * HelperSet represents a set of helpers to be used with a command.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class HelperSet implements \IteratorAggregate
{
<<<<<<< HEAD
    /** @var array<string, Helper> */
=======
    /**
     * @var Helper[]
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    private $helpers = [];
    private $command;

    /**
     * @param Helper[] $helpers An array of helper
     */
    public function __construct(array $helpers = [])
    {
        foreach ($helpers as $alias => $helper) {
            $this->set($helper, \is_int($alias) ? null : $alias);
        }
    }

    public function set(HelperInterface $helper, string $alias = null)
    {
        $this->helpers[$helper->getName()] = $helper;
        if (null !== $alias) {
            $this->helpers[$alias] = $helper;
        }

        $helper->setHelperSet($this);
    }

    /**
     * Returns true if the helper if defined.
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return bool true if the helper is defined, false otherwise
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function has(string $name)
    {
        return isset($this->helpers[$name]);
    }

    /**
     * Gets a helper value.
     *
<<<<<<< HEAD
     * @return HelperInterface
=======
     * @return HelperInterface The helper instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @throws InvalidArgumentException if the helper is not defined
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(sprintf('The helper "%s" is not defined.', $name));
        }

        return $this->helpers[$name];
    }

<<<<<<< HEAD
    /**
     * @deprecated since Symfony 5.4
     */
    public function setCommand(Command $command = null)
    {
        trigger_deprecation('symfony/console', '5.4', 'Method "%s()" is deprecated.', __METHOD__);

=======
    public function setCommand(Command $command = null)
    {
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        $this->command = $command;
    }

    /**
     * Gets the command associated with this helper set.
     *
<<<<<<< HEAD
     * @return Command
     *
     * @deprecated since Symfony 5.4
     */
    public function getCommand()
    {
        trigger_deprecation('symfony/console', '5.4', 'Method "%s()" is deprecated.', __METHOD__);

=======
     * @return Command A Command instance
     */
    public function getCommand()
    {
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        return $this->command;
    }

    /**
<<<<<<< HEAD
     * @return \Traversable<string, Helper>
     */
    #[\ReturnTypeWillChange]
=======
     * @return Helper[]
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function getIterator()
    {
        return new \ArrayIterator($this->helpers);
    }
}
