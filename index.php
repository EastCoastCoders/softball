<?php
/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/12/2015
 * Time: 5:56 PM
 */

    include "Database/db.php";
    include "Database/Tables/PlayersTable.php";
    include "Database/Tables/BatterStatsTable.php";
    include "Database/Tables/PollsTable.php";
    include "Database/Tables/AdminsTable.php";
    include "Database/Tables/EventsTable.php";
    include "Database/Tables/PitcherStatsTable.php";

    $pitcherTable = new PitcherStatsTable();
    $pitcherObject = new PitcherObject();

    $pitcherObject->setWin(3);
    $pitcherObject->setLoss(2);
    $pitcherObject->setInningsPitched(22);
    $pitcherObject->setRunsAllowed(12);
    $pitcherObject->setEarnedRunsAllowed(10);
    $pitcherObject->setWalksAllowed(4);
    $pitcherObject->setStrikeOuts(12);

    $pitcherObject->calcEra();

    $pitcherTable->create($pitcherObject);


    /*$eventsTable = new EventsTable();
    $eventsObject = new EventsObject();

    $eventsObject->setName("Bob");
    $eventsObject->setDescription("Bob is a great man and I hope he has a great life.");
    $eventsObject->setImage("ImageGoesHere");
    $eventsObject->setDate("Today");

    $eventsTable->create($eventsObject);
    */

