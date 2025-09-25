<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:3000',         // local dev
        'https://j-pich-front-5for-3bh78tcn9-honghavs-projects.vercel.app', // your deployed frontend
    ],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
