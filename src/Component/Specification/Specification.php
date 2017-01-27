<?php

namespace Tenolo\Bundle\EntityBundle\Component\Specification;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Specification
 *
 * @package Tenolo\Bundle\EntityBundle\Component\Specification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
abstract class Specification extends \Rb\Specification\Doctrine\Specification
{
    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $resolved = $resolver->resolve($options);
        $elements = $this->buildSpecification($resolved);

        parent::__construct($elements);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * @param array $options
     *
     * @return array
     */
    abstract protected function buildSpecification(array $options);
}
