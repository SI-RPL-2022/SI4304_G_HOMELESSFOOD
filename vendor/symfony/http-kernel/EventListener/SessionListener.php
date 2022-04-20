<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\EventListener;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
<<<<<<< HEAD
use Symfony\Component\HttpKernel\Event\RequestEvent;
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

/**
 * Sets the session in the request.
 *
 * When the passed container contains a "session_storage" entry which
 * holds a NativeSessionStorage instance, the "cookie_secure" option
<<<<<<< HEAD
 * will be set to true whenever the current main request is secure.
=======
 * will be set to true whenever the current master request is secure.
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class SessionListener extends AbstractSessionListener
{
<<<<<<< HEAD
    public function onKernelRequest(RequestEvent $event)
    {
        parent::onKernelRequest($event);

        if (!$event->isMainRequest() || (!$this->container->has('session') && !$this->container->has('session_factory'))) {
            return;
        }

        if ($this->container->has('session_storage')
            && ($storage = $this->container->get('session_storage')) instanceof NativeSessionStorage
            && ($mainRequest = $this->container->get('request_stack')->getMainRequest())
            && $mainRequest->isSecure()
        ) {
            $storage->setOptions(['cookie_secure' => true]);
        }
=======
    public function __construct(ContainerInterface $container, bool $debug = false)
    {
        parent::__construct($container, $debug);
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }

    protected function getSession(): ?SessionInterface
    {
<<<<<<< HEAD
        if ($this->container->has('session')) {
            return $this->container->get('session');
        }

        if ($this->container->has('session_factory')) {
            return $this->container->get('session_factory')->createSession();
=======
        if (!$this->container->has('session')) {
            return null;
        }

        if ($this->container->has('session_storage')
            && ($storage = $this->container->get('session_storage')) instanceof NativeSessionStorage
            && ($masterRequest = $this->container->get('request_stack')->getMasterRequest())
            && $masterRequest->isSecure()
        ) {
            $storage->setOptions(['cookie_secure' => true]);
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }

        return $this->container->get('session');
    }
}
