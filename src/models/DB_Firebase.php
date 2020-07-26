<?php

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

class DB_Firebase {

    public function __construct(){

        var_dump(file_exists('../secrets/raspibar-35706-firebase-adminsdk-iy139-ae3e81ee71.json'));
        $acc = ServiceAccount::fromJsonFile('../secrets/raspibar-35706-firebase-adminsdk-iy139-ae3e81ee71.json');

       $firebase = (new Factory)->withServiceAccount($acc)->create();

       return $firebase->getDatabase();
    }

}