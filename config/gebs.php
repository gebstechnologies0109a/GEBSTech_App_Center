<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Iframe embedding (GEBS App Center)
    |--------------------------------------------------------------------------
    |
    | Allowed parent origins for api, portal, frosty, and main DIY Biz domains.
    |
    */
    'frame_ancestors' => env(
        'GEBS_FRAME_ANCESTORS',
        'https://api.diybizrewards.com https://portal.diybizrewards.com https://frosty.diybizrewards.com https://diybizrewards.com https://www.diybizrewards.com'
    ),

    'app_center_url' => env('APP_URL', 'https://apps.diybizrewards.com'),

];
