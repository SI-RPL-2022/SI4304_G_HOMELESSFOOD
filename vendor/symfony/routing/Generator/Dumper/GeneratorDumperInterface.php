<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Generator\Dumper;

use Symfony\Component\Routing\RouteCollection;

/**
 * GeneratorDumperInterface is the interface that all generator dumper classes must implement.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface GeneratorDumperInterface
{
    /**
     * Dumps a set of routes to a string representation of executable code
     * that can then be used to generate a URL of such a route.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string Executable code
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function dump(array $options = []);

    /**
     * Gets the routes to dump.
     *
<<<<<<< HEAD
     * @return RouteCollection
=======
     * @return RouteCollection A RouteCollection instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getRoutes();
}
