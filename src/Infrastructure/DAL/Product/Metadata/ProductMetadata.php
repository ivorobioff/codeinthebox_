<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Metadata;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use ImmediateSolutions\Support\Infrastructure\Doctrine\Metadata\AbstractMetadataProvider;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ProductMetadata extends AbstractMetadataProvider
{
    /**
     * @param ClassMetadataBuilder $builder
     * @return void
     */
    public function define(ClassMetadataBuilder $builder)
    {
        // TODO: Implement define() method.
    }
}