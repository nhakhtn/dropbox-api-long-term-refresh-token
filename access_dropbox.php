<?php
require 'vendor/autoload.php';

$key = '70cvl6dzde2hwy3';
$secret = 'fqiyvbon8c6m630';
$refreshToken = '-ToincaCogsAAAAAAAAAAVSPMj1UcbKpn7lKzHgaTdfi_Qkh7A5KSQTDjimye5Rf';

$tokenProvider = new Spatie\Dropbox\AutoRefreshingDropBoxTokenService($key, $secret, $refreshToken);
$client = new Spatie\Dropbox\Client($tokenProvider);

//check vendor/spatie/dropbox-api/src/client.php to see what we can do with this $client
$listfolders = $client->listFolder('');
var_dump($listfolders);