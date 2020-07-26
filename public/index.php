<?php

require '../blog/public/index.php';

require '../vendor/autoload.php';
require '../src/autoloader.php';
$server = Server::getInstance();
$server->start($options = ['env' => 'local']);


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// echo '<pre>';

/*
$serviceAccount = ServiceAccount::fromJsonFile('./firebase.json');

$firebase = (new Factory)
->withServiceAccount($serviceAccount)
->withDatabaseUri('https://raspibar-35706.firebaseio.com')
->create();

$database = $firebase->getDatabase();
$reference = '/raspberry/gpio';
$snapshot = $database->getReference($reference)->getSnapshot();
$data = $snapshot->getValue();
echo var_export($data, true);
*/

$gpios = [
  'pump1' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '17',
    'pin_id' => 'pump1',
    'pin_name' => 'update2',
  ],
  'pump2' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '18',
    'pin_id' => 'pump2',
    'pin_name' => 'GPIO 1',
  ],
  'pump3' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '27',
    'pin_id' => 'pump3',
    'pin_name' => 'GPIO 2',
  ],
  'pump4' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '22',
    'pin_id' => 'pump4',
    'pin_name' => 'GPIO 3',
  ],
  'pump5' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '23',
    'pin_id' => 'pump5',
    'pin_name' => 'GPIO 4',
  ],
  'pump6' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '24',
    'pin_id' => 'pump6',
    'pin_name' => 'GPIO 5',
  ],
  'pump7' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '25',
    'pin_id' => 'pump7',
    'pin_name' => 'GPIO 6',
  ],
  'pump8' =>
  [
    'pin_bcm' => '0',
    'pin_gpio' => '26',
    'pin_id' => 'pump8',
    'pin_name' => 'GPIO 25',
  ],
];

/*
foreach($snapshot->getValue() as $k => $gpio){ 
   $gpios[$gpio['pin_id']] = $gpio;	
}
*/

// echo var_export($gpios, true);


$parameters = json_decode(file_get_contents('php://input'), true);
// echo var_export($parameters, true);

$pumps = $parameters['pumps'];

$commandStr = 'python scriptgpio.py ';

foreach ($pumps as $pump) {
  $pumpId = $pump['pumpId'];
  $during = $pump['during'];
  // echo var_export($pumpId, true);

  if (array_search($pumpId, $gpios[$pumpId]) !== false) {
    $pinGpio = $gpios[$pumpId]['pin_gpio'];
    $commandStr .= $pinGpio . ':' . $during . ',';
    // var_dump($pinGpio);
    // $command = escapeshellcmd('python scriptgpio.py '.$pinGpio.' '.$during);
    // var_dump($command); die;
    // $output = shell_exec($command);
    // echo $output;
  } else {
    var_dump('no gpio found');
    die;
  }
}

$commandStr = substr($commandStr, 0, -1);

// echo var_export($commandStr, true);

$command = escapeshellcmd($commandStr);
// var_dump($command); die;
$output = shell_exec($command);
echo $output;

// echo '</pre>';
