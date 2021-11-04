<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'juniel/app-goobe',
        'dev' => true,
    ),
    'versions' => array(
        'heroku/heroku-buildpack-php' => array(
            'pretty_version' => 'v200',
            'version' => '200.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../heroku/heroku-buildpack-php',
            'aliases' => array(),
            'reference' => 'ffa4d0e714439d6f54f9608a0aa16674e82ed0a1',
            'dev_requirement' => false,
        ),
        'juniel/app-goobe' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
    ),
);
