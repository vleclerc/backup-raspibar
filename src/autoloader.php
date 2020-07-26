<?php

spl_autoload_register(function ($className) {
        
    $srcDirs = [
        '/', 
        '/models/', 
        '/controllers/'
    ];

    $extension = '.php';
    $fileName = $className . $extension;

    foreach($srcDirs as $dirName){
        if (file_exists(__DIR__ . $dirName . $fileName)) {
            require_once __DIR__ . $dirName . $fileName;
            break;
        } 
        else {
            continue;
        }
    }

});

?>