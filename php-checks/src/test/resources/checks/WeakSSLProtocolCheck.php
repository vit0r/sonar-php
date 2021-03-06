<?php
// Recent SSL Protocol Versions

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_SSLv3_CLIENT
    ],
]);

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_SSLv3_SERVER
    ],
]);

stream_socket_enable_crypto($ctx, true, STREAM_CRYPTO_METHOD_TLSv1_2_SERVER);

// Unknown SSL Protocol Used

stream_context_create();

stream_context_create(getConfig());

$ctx = stream_context_create([
    'ssl' => getSSLConfig()
]);

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => getSSLProtocol()
    ],
]);

stream_socket_enable_crypto($ctx, true, getSSLProtocol());

stream_socket_enable_crypto($ctx, true);

stream_context_create([
        'http'=>[
            'method'=>"GET"
        ]
]);

// Older SSL Protocol Versions

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT, // Noncompliant{{Change this code to use a stronger protocol.}}
//                         ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    ],
]);

$ctx = stream_context_create(array(
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT, // Noncompliant
//                         ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    ],
));

$ctx = stream_context_create(array(
    'ssl' => array(
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT, // Noncompliant
//                         ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    )
));

stream_socket_enable_crypto($$ctx, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT); // Noncompliant

// Using variable for configuration

$cryptoMethod = STREAM_CRYPTO_METHOD_ANY_CLIENT; // Noncompliant

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => $cryptoMethod
    ],
]);

$ctxConfig = ['ssl' => [
'crypto_method' => STREAM_CRYPTO_METHOD_ANY_CLIENT // Noncompliant
]];

$ctx = stream_context_create($ctxConfig);

$sslConfig = [
'crypto_method' => STREAM_CRYPTO_METHOD_ANY_CLIENT // Noncompliant
];

$ctx = stream_context_create([
    'ssl' => $sslConfig,
]);

$maybeSSLConfig = [
'crypto_method' => STREAM_CRYPTO_METHOD_ANY_CLIENT
];

if (condition()) {
    $maybeSSLConfig = [
        'crypto_method' => STREAM_CRYPTO_METHOD_SSLv3_CLIENT
    ];
}

$ctx = stream_context_create([
    'ssl' => $maybeSSLConfig,
]);

$unused = STREAM_CRYPTO_METHOD_ANY_CLIENT;

$sslv23 = STREAM_CRYPTO_METHOD_SSLv23_CLIENT; // Noncompliant

stream_socket_enable_crypto($$ctx, true, $sslv23);

// Using Bitwise OR

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT | // Noncompliant
                            STREAM_CRYPTO_METHOD_TLSv1_1_SERVER, // Noncompliant
    ],
]);

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT | // Noncompliant
                            STREAM_CRYPTO_METHOD_TLSv1_1_SERVER | // Noncompliant
                            STREAM_CRYPTO_METHOD_TLSv1_2_SERVER
    ],
]);

$ctx = stream_context_create([
    'ssl' => [
        'crypto_method' => getOthers() |
                           STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT // Noncompliant
    ],
]);

stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLSv1_2_SERVER | STREAM_CRYPTO_METHOD_TLSv1_1_SERVER); // Noncompliant
