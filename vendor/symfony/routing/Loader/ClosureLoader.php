<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

/**
 * ClosureLoader loads routes from a PHP closure.
 *
 * The Closure must return a RouteCollection instance.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ClosureLoader extends Loader
{
    /**
     * Loads a Closure.
     *
     * @param \Closure    $closure A Closure
     * @param string|null $type    The resource type
     *
<<<<<<< HEAD
     * @return RouteCollection
=======
     * @return RouteCollection A RouteCollection instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function load($closure, string $type = null)
    {
        return $closure();
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, string $type = null)
    {
        return $resource instanceof \Closure && (!$type || 'closure' === $type);
    }
}
