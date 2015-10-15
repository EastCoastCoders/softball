<?php

/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/12/2015
 * Time: 8:51 PM
 */
class PollObject
{
    private $id;
    private $question;
    private $yes;
    private $no;

    /**
     * PollObject constructor.
     * @param $question
     * @param $yes
     * @param $no
     */
    public function __construct($question = null, $yes = null, $no = null)
    {
        $this->question = $question;
        $this->yes      = $yes;
        $this->no       = $no;
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
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getYes()
    {
        return $this->yes;
    }

    /**
     * @param mixed $yes
     */
    public function setYes($yes)
    {
        $this->yes = $yes;
    }

    /**
     * @return mixed
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * @param mixed $no
     */
    public function setNo($no)
    {
        $this->no = $no;
    }


}

Class PollsTable extends Database
{

    /** Create Statement Variables **/

    private $id;
    private $question;
    private $yes;
    private $no;

    public function __construct()
    {
        parent::__construct();

        // prepare Create Statement
        $this->createStatement = $this->connection->prepare("INSERT INTO polls(question, yes, `no`) VALUES (?,?,?)");
        $this->createStatement->bind_param("sii", $this->question, $this->yes, $this->no);

        // prepare read statement
        $this->readStatement = $this->connection->prepare("SELECT * FROM polls WHERE id = ?");
        $this->readStatement->bind_param("i", $this->id);

        // prepare update statement
        $this->updateStatement = $this->connection->prepare("UPDATE polls SET question = ?, yes = ?, `no` = ?");
        $this->updateStatement->bind_param("sii", $this->question, $this->yes, $this->no);

        // prepare delete statement
        $this->deleteStatement = $this->connection->prepare("DELETE FROM polls WHERE id = ?");
        $this->deleteStatement->bind_param("i", $this->id);
    }

    /**
     * @param PollObject $pollObject
     */
    public function create($pollObject)
    {

        $this->question = parent::cleanData($pollObject->getQuestion());
        $this->yes      = (int)parent::cleanData($pollObject->getYes());
        $this->no       = (int)parent::cleanData($pollObject->getNo());

        $this->createStatement->execute();

    }

    public function read($id)
    {
        $this->id = (int)$id;
        $this->readStatement->execute();

        $result = $this->readStatement->get_result();
        $poll   = new PollObject();

        while ($row = $result->fetch_object()) {
            $poll->setQuestion($row->question);
            $poll->setYes($row->yes);
            $poll->setNo($row->no);
        }

        return $poll;

    }

    /**
     * @param PollObject $pollObject
     */
    public function update($pollObject)
    {

        $oldData = $this->read($pollObject->getId());

        $this->question = ($pollObject->getQuestion() !== null) ? parent::cleanData($pollObject->getQuestion()) : $oldData->getQuestion();
        $this->yes      = ($pollObject->getYes() !== null) ? parent::cleanData($pollObject->getYes()) : $oldData->getYes();
        $this->no       = ($pollObject->getNo() !== null) ? parent::cleanData($pollObject->getNo()) : $oldData->getNo();


    }

    public function delete($id)
    {

        $this->id = (int)$id;

        $this->deleteStatement->execute();


    }


}