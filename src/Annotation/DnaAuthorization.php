<?php

namespace Tenolo\Bundle\EntityBundle\Annotation;

/**
 * Class DnaAuthorization
 *
 * @package Tenolo\Bundle\EntityBundle\Annotation
 * @author  Nikita Loges
 * @company tenolo GbR
 *
 * @Annotation
 * @Target("METHOD")
 */
class DnaAuthorization
{

    /** @var string */
    public $className;

    /** @var string */
    public $paramName;

    /** @var string */
    public $dna = 'dna';

    /** @var string */
    public $nullable = true;

    public function __construct($options)
    {
        if (isset($options['value'])) {
            $options['paramName'] = $options['value'];
            unset($options['value']);
        }

        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist', $key));
            }

            $this->$key = $value;
        }
    }
}
