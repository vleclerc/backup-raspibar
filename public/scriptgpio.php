<?php

$scriptName = 'scriptgpio.py';
$pumpId = $argv['1'];
$during = $argv['2'];

$command = escapeshellcmd(dirname(__FILE__).'/'.$scriptName.' '.$pumpId.' '.$during);

$output = shell_exec($command);
echo $output;
