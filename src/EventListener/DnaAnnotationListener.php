<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tenolo\Bundle\EntityBundle\Annotation\DnaAuthorization;

/**
 * Class DnaAnnotationListener
 *
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DnaAnnotationListener
{

    /** @var Reader */
    protected $reader;

    /** @var RequestStack */
    protected $requestStack;

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(Reader $reader, RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->reader = $reader;
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @return NotFoundHttpException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;

        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $annotationName = DnaAuthorization::class;
        $request = $this->requestStack->getMasterRequest();

        // Get method annotation
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);

        /** @var DnaAuthorization $methodAnnotation */
        $methodAnnotation = $this->reader->getMethodAnnotation($reflectionMethod, $annotationName);

        if ($methodAnnotation) {
            $paramName = $methodAnnotation->paramName;
            $paramValue = $request->get($paramName);

            if ($methodAnnotation->className) {
                $className = $methodAnnotation->className;
            } else {
                $params = new ArrayCollection($reflectionMethod->getParameters());
                $params = $params->filter(function (\ReflectionParameter $parameter) use ($paramName) {
                    return ($parameter->getName() == $paramName);
                });

                if (!$params->count()) {
                    return;
                }

                /** @var \ReflectionParameter $param */
                $param = $params->first();
                $className = $param->getClass()->getName();
            }

            $entity = $this->entityManager->getRepository($className)->find($paramValue);
            $dna = $request->get($methodAnnotation->dna);

            if ($entity->getDna() != $dna) {
                return new NotFoundHttpException('Not Found');
            }
        }
    }
}
