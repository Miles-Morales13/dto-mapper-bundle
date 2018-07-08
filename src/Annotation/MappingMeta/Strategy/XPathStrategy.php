<?php

namespace DTOMapperBundle\Annotation\MappingMeta\Strategy;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"PROPERTY", "ANNOTATION"})
 */
class XPathStrategy extends AbstractStrategy
{
    /**
     * @Required
     * @var string
     */
    public $xPath;

    /**
     * @return string
     */
    public function getXPath(): string
    {
        return $this->xPath;
    }
}
