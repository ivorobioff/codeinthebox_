<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Metadata;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\KindType;
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
        $builder->setTable('products');

        $builder
            ->createField('id', 'integer')
            ->generatedValue()
            ->makePrimaryKey()
            ->build();

        $builder
            ->createField('kind', KindType::class)
            ->nullable(false)
            ->build();

        $builder
            ->createField('image', 'string')
            ->nullable(true)
            ->build();

        $builder
            ->createField('shortDescription', 'string')
            ->nullable(true)
            ->build();

        $builder
            ->createField('longDescription', 'text')
            ->nullable(true)
            ->build();
    }
}