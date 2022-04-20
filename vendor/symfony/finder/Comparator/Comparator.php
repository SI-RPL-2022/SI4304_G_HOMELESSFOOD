<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Comparator;

/**
 * Comparator.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Comparator
{
    private $target;
    private $operator = '==';

<<<<<<< HEAD
    public function __construct(string $target = null, string $operator = '==')
    {
        if (null === $target) {
            trigger_deprecation('symfony/finder', '5.4', 'Constructing a "%s" without setting "$target" is deprecated.', __CLASS__);
        }
=======
    /**
     * Gets the target value.
     *
     * @return string The target value
     */
    public function getTarget()
    {
        return $this->target;
    }
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

    public function setTarget(string $target)
    {
        $this->target = $target;
<<<<<<< HEAD
        $this->doSetOperator($operator);
    }

    /**
     * Gets the target value.
     *
     * @return string
     */
    public function getTarget()
    {
        if (null === $this->target) {
            trigger_deprecation('symfony/finder', '5.4', 'Calling "%s" without initializing the target is deprecated.', __METHOD__);
        }

        return $this->target;
    }

    /**
     * @deprecated set the target via the constructor instead
     */
    public function setTarget(string $target)
    {
        trigger_deprecation('symfony/finder', '5.4', '"%s" is deprecated. Set the target via the constructor instead.', __METHOD__);

        $this->target = $target;
    }

    /**
     * Gets the comparison operator.
     *
     * @return string
     */
    public function getOperator()
=======
    }

    /**
     * Gets the comparison operator.
     *
     * @return string The operator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Sets the comparison operator.
     *
     * @throws \InvalidArgumentException
     */
    public function setOperator(string $operator)
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    {
        if ('' === $operator) {
            $operator = '==';
        }

        if (!\in_array($operator, ['>', '<', '>=', '<=', '==', '!='])) {
            throw new \InvalidArgumentException(sprintf('Invalid operator "%s".', $operator));
        }

        $this->operator = $operator;
    }

    /**
     * Sets the comparison operator.
     *
     * @throws \InvalidArgumentException
     *
     * @deprecated set the operator via the constructor instead
     */
    public function setOperator(string $operator)
    {
        trigger_deprecation('symfony/finder', '5.4', '"%s" is deprecated. Set the operator via the constructor instead.', __METHOD__);

        $this->doSetOperator('' === $operator ? '==' : $operator);
    }

    /**
     * Tests against the target.
     *
     * @param mixed $test A test value
     *
     * @return bool
     */
    public function test($test)
    {
        if (null === $this->target) {
            trigger_deprecation('symfony/finder', '5.4', 'Calling "%s" without initializing the target is deprecated.', __METHOD__);
        }

        switch ($this->operator) {
            case '>':
                return $test > $this->target;
            case '>=':
                return $test >= $this->target;
            case '<':
                return $test < $this->target;
            case '<=':
                return $test <= $this->target;
            case '!=':
                return $test != $this->target;
        }

        return $test == $this->target;
    }

    private function doSetOperator(string $operator): void
    {
        if (!\in_array($operator, ['>', '<', '>=', '<=', '==', '!='])) {
            throw new \InvalidArgumentException(sprintf('Invalid operator "%s".', $operator));
        }

        $this->operator = $operator;
    }
}
