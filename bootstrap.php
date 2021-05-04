<?php

use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->beforeBuild(function (Jigsaw $jigsaw) {
   $env = $jigsaw->getEnvironment();

   if (strval($env) === 'production' || strval($env) === 'prod') {
        $jigsaw->setDestinationPath(__DIR__ . '/docs');
   }
});

$events->afterBuild(function (Jigsaw $jigsaw) {
   $env = $jigsaw->getEnvironment();

   if (strval($env) === 'production' || strval($env) === 'prod') {
        $path = $jigsaw->getDestinationPath();

        file_put_contents($path . '/CNAME', 'theblackbookshelf.com');
   }
});
