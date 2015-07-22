<?php

return [

    /*
    | System Setting.
    */

    // Use admin route from the package.
    'admin_route' => true,
    // The path to your backend system, ex. '/admin' for 'www.your-domain.com/admin'
    'admin_path' => 'backadmin',

    // Use public route from the package.
    'public_route' => true,
    // The path to public route, ex. '/blog' for 'www.your-domain.com/blog'.
    'public_path' => 'blog',

    // Use as real path to the file folder (the folder should have write permission).
    'file_path' => storage_path('app/upload/'),
    // This path can be use with asset() to generate url to the file folder.
    'file_asset_url' => 'storage/app/upload/',

    // The path to thumbnail generate by the package (the folder should have write permission).
    'thumb_path' => storage_path('app/images/blog/'),
    'thumb_asset_url' => 'storage/app/images/blog/',

    /*
    | Blog Category
    */

    'category_thumb' => true,

    'category_thumb_width' => 264,

    'category_thumb_height' => 142,

    /*
    | Blog
    */

    'blogs_per_page' => 15,

    'highlight' => true,

    'thumb_width' => 264,

    'thumb_height' => 142

];