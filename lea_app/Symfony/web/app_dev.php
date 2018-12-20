<?php

use Symfony\Component\HttpFoundation\Request;
ini_set('memory_limit', '512M');
set_time_limit(300);
date_default_timezone_set('Europe/Paris'); 
// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.

define('DIR','/lea_app/Symfony/web');

//define('DIR','');

// define('DIR_PRESTA','http://apsie18.test.spirea.fr');
define('DIR_PRESTA','https://lea143.apsie.org');

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
