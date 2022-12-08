<?php

use craft\helpers\App;
use benf\neo\elements\Block;
use Illuminate\Support\Collection;

return [
    'endpoints' => [
        'api/block/<id:\d+>' => function ($id) {
            return [
                'elementType' => Block::class,
                'cache' => App::env('ENVIRONMENT') === 'production',
                'one' => true,
                'criteria' => [
                    'id' => $id,
                    // 'with' => ['children'] // eager-loading has no effect
                ],
                'transformer' => function (Block $block) {
                    $children = new Collection($block->children->all());

                    return [
                        'id' => $block->id,
                        'children' => $children->map(function ($child) {
                            return  [
                                'id' => $child->id,
                                'text' => trim($child->text)
                            ];
                        })
                    ];
                }
            ];
        }
    ]
];
