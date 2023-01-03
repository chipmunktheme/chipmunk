<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        // Illuminate\Auth\AuthServiceProvider::class,
        // Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        // Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        // Illuminate\Cookie\CookieServiceProvider::cl::class,
        // Illuminate\Encryption\EncryptionServiceProvider::class,
        // Illuminate\Filesystem\FilesystemServiceProvider::class,
        // Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        // Illuminate\Hashing\HashServiceProvider::class,
        // Illuminate\Mail\MailServiceProvider::class,
        // Illuminate\Notifications\NotificationServiceProvider::class,
        // Illuminate\Pagination\PaginationServiceProvider::class,
        // Illuminate\Pipeline\PipelineServiceProvider::class,
        // Illuminate\Queue\QueueServiceProvider::class,
        // Illuminate\Redis\RedisServiceProvider::class,
        // Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        // Illuminate\Session\SessionServiceProvider::class,
        // Illuminate\Translation\TranslationServiceProvider::class,
        // Illuminate\Validation\ValidationServiceProvider::class,
        Roots\Acorn\Assets\AssetsServiceProvider::class,
        Roots\Acorn\Filesystem\FilesystemServiceProvider::class,
        Roots\Acorn\Providers\AcornServiceProvider::class,
        Roots\Acorn\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Log1x\AcfComposer\Providers\AcfComposerServiceProvider::class,

        /*
        * Application Service Providers...
        */
        App\Providers\AssetServiceProvider::class,
        App\Providers\OptionServiceProvider::class,
        App\Providers\ThemeServiceProvider::class,
        App\Providers\ViewServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        'Helper' => App\Facades\Helper::class,
    ],

];
