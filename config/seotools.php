<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults' => [
            'title' => env('APP_NAME'), // set false to total remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' =>
                'list of latest laravel news and tutorials scraped from multible websites', // set false to total remove
            'separator' => ' - ',
            'keywords' => [
                'laravel',
                'laravel tutorial',
                'laravel news',
                'laravel news tutorial',
                'web scraper',
                'php goutte',
                'php web scraper',
                'laravel web scraper',
                'dor.ky',
                'scotch.io',
                'digitalocean',
                'digitalocean laravel',
                'envato Tuts Laravel',
                'envato Tuts Laravel',
                'laraveldaily',
                'pusher',
                'pusher laravel',
                'stillat',
                'stillat laravel',
                'vegibit',
                'vegibit laravel'
            ],
            'canonical' => null, // Set null for using Url::current(), set false to total remove
            'robots' => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google' => null,
            'bing' => null,
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
            'norton' => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title' => env('APP_NAME'), // set false to total remove
            'description' => 'list of latest laravel news and tutorials scraped from multible websites', // set false to total remove
            'url' => null, // Set null for using Url::current(), set false to total remove
            'type' => false,
            'site_name' => env('APP_NAME'),
            'images' => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            // 'card'        => 'summary',
            // 'site'        => '@abo3adel35',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title' => false, // set false to total remove
            'description' => false, // set false to total remove
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => 'WebPage',
            'images' => [],
        ],
    ],
];
