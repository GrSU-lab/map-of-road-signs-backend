<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */
    'dir' => ['files'],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
<<<<<<< HEAD
    | The default group settings for the  routes.
=======
    | The default group settings for the elFinder routes.
>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7
    |
    */

    'route' => [
<<<<<<< HEAD
        'prefix' => '',
=======
        'prefix' => 'elfinder',
>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7
        'middleware' => array('web'), //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

<<<<<<< HEAD
    'access' => 'Barryvdh\\::checkAccess',
=======
    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',
>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => null,

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
<<<<<<< HEAD
    | See https://github.com/Studio-42//wiki/Connector-configuration-options-2.1
=======
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7
    |
    */

    'options' => array(),
    
    /*
    |--------------------------------------------------------------------------
    | Root Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with every root by default.
<<<<<<< HEAD
    | See https://github.com/Studio-42//wiki/Connector-configuration-options-2.1#root-options
=======
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1#root-options
>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7
    |
    */
    'root_options' => array(

    ),

);
