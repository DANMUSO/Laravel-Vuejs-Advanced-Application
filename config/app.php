<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'name' => env('APP_NAME', 'Xoom Gas'),
    'externalmpesaapikey' => env('EXTERNAL_MPESA_API', 'ASED@EFDDD21212WSWEWDEWEwedw#$#@23432222'),
    'apikey' => env('API_KEY_SANDBOX', '9b5059effc83bd177f9c61d7aa9c727449f70f6d5f939837e6a6a7e058c5e970'),
    'paymentapikeylive' => env('API_KEY_LIVE', 'a168e04a18373dc78b819b23d63f44d2ce3433390e51a05b55825d6d87955762'),
    'aws_url' => env('AWS_URL','https://xoom-prod.s3-eu-west-2.amazonaws.com/'),
    'fcmapiaccesskey' => env('API_FCMACCESS_KEY', 'AAAA5gLzbOw:APA91bFfWkK-VEuCs5tyQm4sJQXVlSoWlkhrXiB1wavOH0CP5os0yLKvjLYVNajOxY0XX6GcxBu1hDykgPU2MJzJiHKiTX1cege2LvLwr94LUnNTW_05oCkSStXQb7khPK9t51TtcNHH'),
    'vendor_add' => env('VENDOR_ADD','Vendor details added successfuly'),
    'vendor_update' => env('VENDOR_UPDATE','Vendor details updated successfuly'),
    'product_add'  => env('PRODUCT_ADD','Product details added successfuly'),
    'product_update'  => env('PRODUCT_UPDATE','Product details updated successfuly'),
    'purchase_add'  => env('PURCHASE_ADD','Purchase Order details added successfuly'),
    'purchase_update'  => env('PURCHASE_UPDATE','Purchase Order details updated successfuly'),
    'error_exception' => env('ERROR_EXCEPTION', 'There is an execution issue. Please contact development team'),
    'rider_add' => env('RIDER_ADD','Rider details added successfuly'),
    'rider_update'  => env('RIDER_UPDATE','Rider details updated successfuly'),
    //RESPONSE MESSAGE
  
    'success' => env('SUCCESS', 'The payment have been reprocessed!'),
    'success_one' => env('SUCCESS_ONE', 'Payment reprocessed'),
    'success_two' => env('SUCCESS_TWO', 'The order is successfully cancelled!'),
    'success_three' => env('SUCCESS_THREE', 'Order Cancelled'),
    'success_product' => env('SUCCESS_PRODUCT', 'Data updated successfully.'),
    'success_purchaseorder' => env('SUCCESS_PURCHASE','Purchase Order updated successfully.'),
    'success_vendor' => env('SUCCESS_VENDOR','Data updated successfully.'),
    'externla_stkpush_url' => env('EXTERNAL_STKPUSH_URL','https://staging-xoomgas-api.herokuapp.com/api/v1/externalapi'),
    'fcm_send_url' => env('FCM_SEND_URL', 'https://fcm.googleapis.com/fcm/send'),
    'status' => env('STATUS', '1'),
    'status_1' => env('STATUS', '0'),
    'status_2' => env('STATUS', '4'),
    'riders' => env('RIDERS', 'RIDERS'),
    'products' => env('PRODUCTS', 'PRODUCTS'),
    'title' => env('TITLE', 'Xoom Gas'),
    'description' => env('DESCRIPTION', 'Office has completed the order. Thank you.'),
    'clienDdescription' => env('CLIENTDESCRIPTION', 'Office has completed this order. Thank you for ordering with us!'),
    'country_code' => env('COUNTRY_CODE', '+254'),
    'phone_no_exist' => env('PHONE_NO_EXIST', 'Phone number Exist'),
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Europe/Moscow',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

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
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Mckenziearts\Notify\LaravelNotifyServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        //FCM
        LaravelFCM\FCMServiceProvider::class,
        //GooglMapper
        Cornford\Googlmapper\MapperServiceProvider::class,

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

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        //FCM
        'FCM'      => LaravelFCM\Facades\FCM::class,
        'FCMGroup' => LaravelFCM\Facades\FCMGroup::class,
        //GooglMapper
        'Mapper'         => Cornford\Googlmapper\Facades\MapperFacade::class,
    ],

];
