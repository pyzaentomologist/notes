<?php

declare(strict_types=1);

namespace App;

require_once('./src/Utils/debug.php');
require_once('./src/Controller.php');
require_once('./src/Request.php');
require_once('./src/Exception/AppException.php');

use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;


$configuration = require_once('./config/config.php');


$request = new Request($_GET, $_POST);

try {
 Controller::initConfiguration($configuration);
 $controller = new Controller($request);
 $controller->run();
 //(new Controller($request))->run();
} catch(ConfigurationException $e){
 echo '<h1>Błąd bazy</h1>';
 echo '<h3>' . $e->getMessage() . '</h3>';
} catch(AppException $e) {
  echo '<h1>Wystąpił błąd aplikacji</h1>';
  echo '<h3>' . $e->getMessage() . '</h3>';
} catch(Throwable $e) {
  echo '<h1>Wystąpił błąd aplikacji</h1>';
  dump($e);
}


