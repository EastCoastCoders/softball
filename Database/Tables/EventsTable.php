<?php

/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/13/2015
 * Time: 8:42 PM
 */
class EventsObject
{

    private $id;
    private $name;
    private $description;
    private $date;
    private $image;

    /**
     * EventsObject constructor.
     * @param $name
     * @param $description
     * @param $date
     * @param $image
     */
    public function __construct($name = null, $description = null, $date = null, $image = null)
    {
        $this->name        = $name;
        $this->description = $description;
        $this->date        = $date;
        $this->image       = $image;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}

Class EventsTable extends Database
{
    private $id;
    private $name;
    private $description;
    private $date;
    private $image;

    public function __construct()
    {
        parent::__construct();

        $this->createStatement = $this->connection->prepare("INSERT INTO `events`(`name`,description, `date`,image) VALUES (?,?,?,?)");
        $this->createStatement->bind_param("ssss", $this->name, $this->description, $this->date, $this->image);

        $this->readStatement = $this->connection->prepare("SELECT * FROM `events` WHERE id = ?");
        $this->readStatement->bind_param("s", $this->id);

        $this->updateStatement = $this->connection->prepare("UPDATE `events` SET `name` = ?, description = ?, `date` = ?, image = ?");
        $this->updateStatement->bind_param("ssss", $this->name, $this->description, $this->date, $this->image);

        $this->deleteStatement = $this->connection->prepare("DELETE FROM `events` WHERE id = ?");
        $this->deleteStatement->bind_param("s", $this->id);


    }

    /**
     * @param EventsObject $EventsObject
     */
    public function create($EventsObject)
    {

        $this->name        = parent::cleanData($EventsObject->getName());
        $this->description = parent::cleanData($EventsObject->getDescription());
        $this->date        = parent::cleanData($EventsObject->getDate());
        $this->image       = parent::cleanData($EventsObject->getImage());


        $this->createStatement->execute();
    }

    public function read($id)
    {

        $this->id = (int)$id;
        $this->readStatement->execute();

        $result = $this->readStatement->get_result();
        $event  = new EventsObject();

        while ($row = $result->fetch_object()) {


            $event->setName($row->name);
            $event->setDescription($row->description);
            $event->setDate($row->date);
            $event->setImage($row->image);

        }

        return $event;

    }

    /**
     * @param EventsObject $EventsObject
     */
    public function update($EventsObject)
    {

        $oldData = $this->read($EventsObject->getId());

        $this->name        = ($EventsObject->getName() !== null) ? parent::cleanData($EventsObject->getName()) : $oldData->getName();
        $this->description = ($EventsObject->getDescription() !== null) ? parent::cleanData($EventsObject->getDescription()) : $oldData->getDescription();
        $this->date        = ($EventsObject->getDate() !== null) ? parent::cleanData($EventsObject->getDate()) : $oldData->getDate();
        $this->image       = ($EventsObject->getImage() !== null) ? parent::cleanData($EventsObject->getImage()) : $oldData->getImage();

        $this->createStatement->execute();
    }

    public function delete($id)
    {

        $this->id = (int) $id;

        $this->deleteStatement->execute();


    }


}