<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:3000',         // local dev
        'https://j-pich-front-5for-3bh78tcn9-honghavs-projects.vercel.app', // version 1
        'https://j-pich-front-5for-eqkvq8tgd-honghavs-projects.vercel.app', // version 2
        'https://j-pich-front-5for-4bp90bui1-honghavs-projects.vercel.app', // Version Hpanel
    ],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
