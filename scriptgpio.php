<?php

$pumpId = $argv['1'];
$during = $argv['2'];

$command = escapeshellcmd('./python '.$pumpId.' '.$during);
$output = shell_exec($command);
echo $output;