<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Fragment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * Interface implemented by all rendering strategies.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface FragmentRendererInterface
{
    /**
     * Renders a URI and returns the Response content.
     *
     * @param string|ControllerReference $uri A URI as a string or a ControllerReference instance
     *
<<<<<<< HEAD
     * @return Response
=======
     * @return Response A Response instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function render($uri, Request $request, array $options = []);

    /**
     * Gets the name of the strategy.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string The strategy name
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getName();
}
