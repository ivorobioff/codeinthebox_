<?php
namespace ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Metadata;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use ImmediateSolutions\CodeInTheBox\Core\Product\Entities\Product;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\NameType;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\ScopeType;
use ImmediateSolutions\CodeInTheBox\Infrastructure\DAL\Product\Types\ValueType;
use ImmediateSolutions\Support\Infrastructure\Doctrine\Metadata\AbstractMetadataProvider;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class FeatureMetadata extends AbstractMetadataProvider
{
    /**
     * @param ClassMetadataBuilder $builder
     * @return void
     */
    public function define(ClassMetadataBuilder $builder)
    {
        $builder->setTable('features');

        $builder
            ->createField('id', 'integer')
            ->generatedValue()
            ->makePrimaryKey()
            ->build();

        $builder
            ->createManyToOne('product', Product::class)
            ->build();

        $builder
            ->createField('name', NameType::class)
            ->nullable(false)
            ->build();

        $builder
            ->createField('scope', ScopeType::class)
            ->nullable(false)
            ->build();

        $builder
            ->createField('estimable', 'boolean')
            ->nullable(false)
            ->build();

        $builder
            ->createField('value', ValueType::class)
            ->nullable(false)
            ->build();
    }
}