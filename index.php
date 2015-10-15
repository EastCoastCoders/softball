<?php
/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/12/2015
 * Time: 5:56 PM
 */

    include "Database/db.php";
    include "Database/Tables/PlayersTable.php";
    include "Database/Tables/GameStatsTable.php";
    include "Database/Tables/PollsTable.php";
    include "Database/Tables/AdminsTable.php";
    include "Database/Tables/EventsTable.php";

    $gameTable = new GameStatsTable();
    $gameObject = new GameObject();

    $gameObject->setPlayersId(3);
    $gameObject->setPosition("1B");
    $gameObject->setAtBats(25);
    $gameObject->setRuns(16);
    $gameObject->setHits(18);
    $gameObject->setDoubles(7);
    $gameObject->setTriples(3);
    $gameObject->setHomeRuns(6);
    $gameObject->setRbi(29);
    $gameObject->setWalks(10);
    $gameObject->setSacFly(3);

    $gameObject->calcPercents();

    $gameTable->create($gameObject);


    /*$eventsTable = new EventsTable();
    $eventsObject = new EventsObject();

    $eventsObject->setName("Bob");
    $eventsObject->setDescription("Bob is a great man and I hope he has a great life.");
    $eventsObject->setImage("ImageGoesHere");
    $eventsObject->setDate("Today");

    $eventsTable->create($eventsObject);
    */


