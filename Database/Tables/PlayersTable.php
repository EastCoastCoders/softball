<?php


/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 08/10/2015
 * Time: 11:04 PM
 */
class PlayerObject
{
    private $id;
    private $firstName;
    private $lastName;
    private $bio;
    private $number;

    /**
     * PlayerObject constructor.
     * @param $firstName
     * @param $lastName
     * @param $bio
     * @param $number
     */
    public function __construct($firstName = null, $lastName = null, $bio = null, $number = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bio = $bio;
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

}


class PlayersTable extends Database
{

    /** Create Statement Variables **/
    private $firstName;
    private $lastName;
    private $bio;
    private $number;


    /* Read Statement Variables */
    private $id;


    public function __construct()
    {
        parent::__construct();// connected to the database

        // prepare Create Statement
        $this->createStatement = $this->connection->prepare("INSERT INTO players (first_name, last_name, bio, `number`) VALUES (?, ?, ?, ?)");
        $this->createStatement->bind_param("sssi", $this->firstName, $this->lastName, $this->bio, $this->number);

        // prepare read statement
        $this->readStatement = $this->connection->prepare("SELECT * FROM players WHERE id = ?");
        $this->readStatement->bind_param("i", $this->id);

        // prepare update statement
        $this->updateStatement = $this->connection->prepare("UPDATE players SET first_name = ?, last_name = ?, bio = ?, number = ?");
        $this->updateStatement->bind_param("sssi", $this->firstName, $this->lastName, $this->bio, $this->number);

        $this->deleteStatement = $this->connection->prepare("DELETE FROM players WHERE id = ?");
        $this->deleteStatement->bind_param("i", $this->id);
    }

    /**
     * @param PlayerObject $playerObject
     */
    public function create($playerObject)
    {
        $this->firstName = parent::cleanData($playerObject->getFirstName());
        $this->lastName = parent::cleanData($playerObject->getLastName());
        $this->bio = parent::cleanData($playerObject->getBio());
        $this->number = (int)parent::cleanData($playerObject->getNumber());

        $this->createStatement->execute();
    }


    public function read($id)
    {

        $this->id = (int)$id;
        $this->readStatement->execute();

        $result = $this->readStatement->get_result();
        $player = new PlayerObject();

        while($row = $result->fetch_object()){


            $player->setFirstName($row->first_name);
            $player->setLastName($row->last_name);
            $player->setBio($row->bio);
            $player->setNumber($row->number);

        }

        return $player;

    }

    /**
     * @param PlayerObject $playerObject
     */

    public function update($playerObject)
    {
        $oldData = $this->read($playerObject->getId());

        $this->firstName = ($playerObject->getFirstName() !== null) ? parent::cleanData($playerObject->getFirstName()) : $oldData->getFirstName();
        $this->lastName = ($playerObject->getLastName() !== null) ? parent::cleanData($playerObject->getLastName()) : $oldData->getLastName();
        $this->bio = ($playerObject->getBio() !== null) ? parent::cleanData($playerObject->getBio()) : $oldData->getBio();
        $this->number = ($playerObject->getNumber() !== null) ? parent::cleanData($playerObject->getNumber()) : $oldData->getNumber();


        $this->updateStatement->execute();

    }

    public function delete($id)
    {

        $this->id = (int) $id;

        $this->deleteStatement->execute();


    }


}