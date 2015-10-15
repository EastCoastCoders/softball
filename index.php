<?php
    /**
     * Created by PhpStorm.
     * User: Daniel
     * Date: 12/10/2015
     * Time: 6:56 PM
     */
    include "Database/database.php";
    include "Database/Tables/PlayersTable.php";

    $playerTable  = new PlayersTable();
    $playerObject = new PlayerObject();

    $playerObject->setFirstName("Greg");
    $playerObject->setLastName("Daniel");
    $playerObject->setBio("I was interested in woman but now that my name is Greg that changes things!");

    $playerTable->update($playerObject);