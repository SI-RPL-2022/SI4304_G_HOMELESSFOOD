<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Bundle;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * BundleInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface BundleInterface extends ContainerAwareInterface
{
    /**
     * Boots the Bundle.
     */
    public function boot();

    /**
     * Shutdowns the Bundle.
     */
    public function shutdown();

    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     */
    public function build(ContainerBuilder $container);

    /**
     * Returns the container extension that should be implicitly loaded.
     *
<<<<<<< HEAD
     * @return ExtensionInterface|null
=======
     * @return ExtensionInterface|null The default extension or null if there is none
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getContainerExtension();

    /**
     * Returns the bundle name (the class short name).
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string The Bundle name
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getName();

    /**
     * Gets the Bundle namespace.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string The Bundle namespace
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getNamespace();

    /**
     * Gets the Bundle directory path.
     *
     * The path should always be returned as a Unix path (with /).
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string The Bundle absolute path
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getPath();
}
