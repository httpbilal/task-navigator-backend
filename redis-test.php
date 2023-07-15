<?php

require __DIR__.'/vendor/autoload.php';

use Predis\Client;

// Redis connection settings
$redisHost = env('REDIS_HOST', '127.0.0.1');
$redisPort = env('REDIS_PORT', 6379);
$redisPassword = env('REDIS_PASSWORD', null);

// Create a new Redis client
$redis = new Client([
    'scheme' => 'tcp',
    'host' => $redisHost,
    'port' => $redisPort,
    'password' => $redisPassword,
]);

// Set a key-value pair in Redis
$redis->set('key', 'value');

// Retrieve the value from Redis
$value = $redis->get('key');

// Output the value
echo $value;
