<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Example Extension (for DDEV for TYPO3 extensions)',
    'description' => 'Your description goes here.',
    'version' => '0.1.0-dev',
    'autoload' => [
        'psr-4' => ['Vendor\\MyExt\\' => 'Classes']
    ],
];
