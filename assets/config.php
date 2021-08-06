<?php

return [
    'model' => ArchTech\Pages\Page::class,

    'views' => [
        /**
         * The layout used to render the pages.
         *
         * @example app-layout For resources/views/app-layout.blade.php
         * @example layouts.app For resources/views/layouts.app.blade.php
         */
        'layout' => 'app-layout',

        /**
         * The path to your views.
         *
         * @example 'pages.' The package will look into resources/views/pages
         * @example 'foo::' The package will look into the 'foo' view namespace
         */
        'path' => 'pages.',

        /**
         * The name of the view used to render markdown pages.
         *
         * @example 'pages._markdown' The package will use resources/views/pages/_markdown.blade.php
         */
        'markdown' => 'pages::_markdown',
    ],

    'routes' => [
        'name' => 'page',
        'prefix' => '',
        'handler' => ArchTech\Pages\PageController::class,
    ],
];
