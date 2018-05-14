<?php
namespace ItemExtend;

return [
    'api_adapters' => [
        'invokables' => [
            'itemextend' => Api\Adapter\MappingAdapter::class,
        ],
    ],
    'entity_manager' => [
        'mapping_classes_paths' => [
            dirname(__DIR__).'/src/Entity',
        ],
        'proxy_paths' => [
            dirname(__DIR__) . '/data/doctrine-proxies',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
    'omeka2_importer_classes' => [
        Omeka2Importer\ExtensionImporter::class,
    ],
];
?>