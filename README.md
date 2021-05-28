# Symfony dto-mapper-bundle

[![Build Status](https://travis-ci.org/vklymniuk/dto-mapper-bundle.svg?branch=develop)](https://travis-ci.org/vklymniuk/dto-mapper-bundle)

## Why use VKMapperBundle?
Bundle makes the process of binding all your data mapping rules a lot more easy by providing annotation declarations.
You can extract content from objects and fill objects from raw arrays.
Instead of slow and dummy reflection classes, the bundle uses fast and performance optimized  [code generator](https://github.com/Ocramius/GeneratedHydrator).
All mapping and DI configurations use native symfony cache and lazy loading.

VKMapperBundle uses customized performance strategies:
 * Converts `Object` to `array`
 * Extracts `Object` to `array`
 * Puts data from `array` into `Object`
 

## Installation

The suggested installation method's via [composer](https://getcomposer.org/):

```sh
php composer.phar require symfony-ext/dto-mapper-bundle
```
 
## Setup

Register bundle in bundles.php file.
```php
<?php

return [
    VKMapperBundle\VKMapperBundle::class => ['all' => true],
];
```

Tag directory with classes that you want add to mapping.
```yaml
    Tests\DataFixtures\Dto\:
      resource: '../../DataFixtures/Dto/*'
      tags:
        - { name: dto_mapper.annotated }
    
    Tests\DataFixtures\Model\:
      resource: '../../DataFixtures/Model/*'
      tags:
        - { name: dto_mapper.annotated }
```
 
Fill in the directory you tagged with annotated classes.
Class example:
 
```php
<?php

namespace Tests\DataFixtures\Dto;

use VKMapperBundle\Annotation\MappingMeta\SourceClass;
use VKMapperBundle\Annotation\MappingMeta\DestinationClass;
use VKMapperBundle\Annotation\MappingMeta\Strategy;

/**
 * @SourceClass
 */
class Source
{
    /**
     * @Strategy\XPathStrategy(xPath="nodeA.inner.optionA")
     */
    public $nodeA;
}

/**
 * @DestinationClass 
 */
class Destination
{
    /**
     * Contains value optionA.
     */
    public $nodeA;
}
```

## Usage

Inject MapperInterface into your service.
```php
<?php

use DataMapper\MapperInterface;

class DataTransformer
{
    public function __construct(MapperInterface $mapper);
}
```

Convert source to dto object:
```php
<?php
use DataMapper\MapperInterface;

/** @var MapperInterface $mapper */
$mapper->convert($source, $destination);
```

Extract content from object into array:
```php
<?php
use DataMapper\MapperInterface;

/** @var MapperInterface $mapper */
$mapper->extract($object);
```


## Documentation
You can learn more about the bundle possibilities and how to use the **VKMapperBundle** in the [docs](docs).
