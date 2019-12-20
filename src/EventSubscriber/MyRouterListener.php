<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Exception\NoConfigurationException;

class MyRouterListener implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        $e = $event->getException();
        if ($e->getPrevious() instanceof NoConfigurationException) {
            $event->setResponse($this->createWelcomeResponse());
        }
    }

    private function createWelcomeResponse()
    {
        return new Response('<h1>Welcome page was changed!</h1>');
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', -63],
        ];
    }
}