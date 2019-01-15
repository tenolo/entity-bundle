<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Tenolo\Bundle\EntityBundle\Annotation\DnaAuthorization;
use Tenolo\Bundle\EntityBundle\Services\EntityDnaVerifier;

/**
 * Class DnaAnnotationListener
 *
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DnaAnnotationListener implements EventSubscriberInterface
{

    /** @var Reader */
    protected $reader;

    /** @var EntityDnaVerifier */
    protected $dnaVerifier;

    /**
     * @param Reader            $reader
     * @param EntityDnaVerifier $dnaVerifier
     */
    public function __construct(Reader $reader, EntityDnaVerifier $dnaVerifier)
    {
        $this->reader = $reader;
        $this->dnaVerifier = $dnaVerifier;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController'
        ];
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;

        $controllerReflection = new \ReflectionObject($controllerObject);
        $methodReflection = $controllerReflection->getMethod($methodName);

        /** @var DnaAuthorization|null $methodAnnotation */
        $methodAnnotation = $this->reader->getMethodAnnotation($methodReflection, DnaAuthorization::class);

        if ($methodAnnotation) {
            if ($methodAnnotation->className) {
                $className = $methodAnnotation->className;
            } else {
                $className = $this->getClassNameFromControllerMethod($methodAnnotation, $methodReflection);
            }

            if (!$this->dnaVerifier->verifyByAnnotation($className, $methodAnnotation)) {
                throw new NotFoundHttpException('Not Found');
            }
        }
    }

    /**
     * @param DnaAuthorization  $authorization
     * @param \ReflectionMethod $reflectionMethod
     *
     * @return string
     */
    protected function getClassNameFromControllerMethod(DnaAuthorization $authorization, \ReflectionMethod $reflectionMethod)
    {
        $params = new ArrayCollection($reflectionMethod->getParameters());
        $params = $params->filter(function (\ReflectionParameter $parameter) use ($authorization) {
            return ($parameter->getName() === $authorization->paramName);
        });

        if (!$params->count()) {
            throw new \RuntimeException('no parameter found');
        }

        /** @var \ReflectionParameter $param */
        $param = $params->first();

        return $param->getClass()->getName();
    }
}
