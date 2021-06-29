<?php



require_once __DIR__.'/core/vendor/mockery/includes/lb_helper.php'; // Include LicenseBox external/client api helper file
$api = new LicenseBoxAPI(); 

$res = $api->verify_license();



define('LARAVEL_START', microtime(true));


require __DIR__.'/core/vendor/autoload.php';



$app = require_once __DIR__.'/core/bootstrap/app.php';



$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
