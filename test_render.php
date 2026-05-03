<?php
use SilverStripe\Control\Director;
use SilverStripe\Core\CoreKernel;

require __DIR__ . '/vendor/autoload.php';

$kernel = new CoreKernel(BASE_PATH);
$app = $kernel->boot(true);

$request = new \SilverStripe\Control\HTTPRequest('GET', 'politics/what-ballot-design-tells-you-about-power');
$response = $app->handle($request);
echo $response->getBody();
