<?php

    /**
     * Created by PhpStorm.
     * User: Daniel
     * Date: 08/10/2015
     * Time: 10:38 PM
     */
    class Database
    {
        // Database credentials
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $db = "softball";

        protected $connection;
        protected $readStatement;
        protected $createStatement;
        protected $updateStatement;
        protected $deleteStatement;

        /**
         * Database constructor.
         */
        public function __construct()
        {
            $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if (!$this->connection) {
                die("Did not connect to database");
            }
        }


        public function create()
        {

        }

        public function read()
        {

        }

        public function update()
        {

        }

        public function delete()
        {

        }

        public function cleanData($value)
        {
            return mysqli_real_escape_string($this->connection, $value);
        }


    }