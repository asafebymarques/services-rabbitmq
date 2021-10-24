<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
            'after_commit' => false,
        ],

        
        
        'rabbitmq' => [

            'driver' => 'rabbitmq',

            /*
         * Set to "horizon" if you wish to use Laravel Horizon.
         */
            'worker' => env('RABBITMQ_WORKER', 'default'),

            'dsn' => env('RABBITMQ_DSN', null),

            'factory_class' => \Enqueue\AmqpBunny\AmqpConnectionFactory::class,

            'host' => env('RABBITMQ_HOST', 'fish-01.rmq.cloudamqp.com'),
            'port' => env('RABBITMQ_PORT', 5672),

            'vhost' => env('RABBITMQ_VHOST', 'pwlywyon'),
            'login' => env('RABBITMQ_USER', 'pwlywyon'),
            'password' => env('RABBITMQ_PASSWORD', 'xPaQUIZZBWolIYr41zmIs6DbzvQ8XhI4'),

            'queue' => env('RABBITMQ_QUEUE', 'default'),

            'options' => [

                'exchange' => [

                    'name' => env('RABBITMQ_EXCHANGE_NAME', 'RABBITMQ_EXCHANGE_NAME'),

                    /*
                 * Determine if exchange should be created if it does not exist.
                 */

                    'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),

                    /*
                 * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                 */

                    'type' => env('RABBITMQ_EXCHANGE_TYPE', \Interop\Amqp\AmqpTopic::TYPE_DIRECT),
                    'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
                    'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                    'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
                    'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
                ],

                'queue' => [

                    /*
                 * Determine if queue should be created if it does not exist.
                 */

                    'declare' => env('RABBITMQ_QUEUE_DECLARE', true),

                    /*
                 * Determine if queue should be binded to the exchange created.
                 */

                    'bind' => env('RABBITMQ_QUEUE_DECLARE_BIND', true),

                    /*
                 * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                 */

                    'passive' => env('RABBITMQ_QUEUE_PASSIVE', false),
                    'durable' => env('RABBITMQ_QUEUE_DURABLE', true),
                    'exclusive' => env('RABBITMQ_QUEUE_EXCLUSIVE', false),
                    'auto_delete' => env('RABBITMQ_QUEUE_AUTODELETE', false),
                    'arguments' => env('RABBITMQ_QUEUE_ARGUMENTS'),
                ],
            ],

            /*
         * Determine the number of seconds to sleep if there's an error communicating with rabbitmq
         * If set to false, it'll throw an exception rather than doing the sleep for X seconds.
         */

            'sleep_on_error' => env('RABBITMQ_ERROR_SLEEP', 5),

            /*
         * Optional SSL params if an SSL connection is used
         * Using an SSL connection will also require to configure your RabbitMQ to enable SSL. More details can be founds here: https://www.rabbitmq.com/ssl.html
         */

            'ssl_params' => [
                'ssl_on' => env('RABBITMQ_SSL', false),
                'cafile' => env('RABBITMQ_SSL_CAFILE', null),
                'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
                'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
