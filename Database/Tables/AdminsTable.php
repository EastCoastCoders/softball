<?php

/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/13/2015
 * Time: 7:50 PM
 */
class AdminObject
{

    private $id;
    private $role;
    private $username;
    private $password;

    /**
     * AdminObject constructor.
     * @param $role
     * @param $username
     * @param $password
     */
    public function __construct($role = null, $username = null, $password = null)
    {
        $this->role     = $role;
        $this->username = $username;
        $this->password = $password;
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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}


Class AdminsTable extends Database
{
    /** Create Statement Variables **/
    private $id;
    private $role;
    private $username;
    private $password;

    public function __construct()
    {
        parent::__construct();

        $this->createStatement = $this->connection->prepare("INSERT INTO admins(role, username, `password`) VALUES(?,?,?)");
        $this->createStatement->bind_param("sss", $this->role, $this->username, $this->password);

        $this->readStatement = $this->connection->prepare("SELECT * FROM admins WHERE id = ?");
        $this->readStatement->bind_param("s", $this->id);

        $this->updateStatement = $this->connection->prepare("UPDATE admins SET role = ?, username = ?, `password` = ?");
        $this->updateStatement->bind_param("sss", $this->role, $this->username, $this->password);

        $this->deleteStatement = $this->connection->prepare("DELETE FROM admins WHERE id = ?");
        $this->deleteStatement->bind_param("s", $this->id);


    }

    /**
     * @param AdminObject $AdminObject
     */
    public function create($AdminObject)
    {
        $this->role     = parent::cleanData($AdminObject->getRole());
        $this->username = parent::cleanData($AdminObject->getUsername());
        $this->password = parent::cleanData($AdminObject->getPassword());

        $this->createStatement->execute();


    }


    public function read($id)
    {

        $this->id = (int)$id;
        $this->readStatement->execute();

        $result = $this->readStatement->get_result();
        $admin  = new AdminObject();

        while ($row = $result->fetch_object()) {

            $admin->setRole($row->role);
            $admin->setUsername($row->username);
            $admin->setPassword($row->password);


        }

        return $admin;

    }

    public function fetchAllRows()
    {
        $query = "SELECT * FROM admins";
        $result = mysqli_query($this->connection, $query);

        $data = array();

        while($row = mysqli_fetch_object($result))
        {
            $data[] = $row;


        }

    return $data;


    }

    /**
     * @param AdminObject $AdminObject
     */
    public function update($AdminObject)
    {

        $oldData = $this->read($AdminObject->getId());

        $this->role     = ($AdminObject->getRole() !== null) ? parent::cleanData($AdminObject->getRole()) : $oldData->getRole();
        $this->username = ($AdminObject->getUsername() !== null) ? parent::cleanData($AdminObject->getUsername()) : $oldData->getRole();
        $this->password = ($AdminObject->getPassword() !== null) ? parent::cleanData($AdminObject->getPassword()) : $oldData->getRole();

        $this->updateStatement->execute();


    }

    public function delete($id)
    {

        $this->id = (int)$id;

        $this->deleteStatement->execute();


    }


}