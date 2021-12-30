<?php

    class DB
    {
        private $connection;

        function __construct()
        {
            $host = "localHost";
            $dbName = "invitations_generator";
            $username = "root";
            $password = "";

            $dsn = "mysql:host=$host;dbname=$dbName";

            $this->connection = new PDO($dsn, $username, $password);
        }

        public function getConnection()
        {
            return $this->connection;
        }
    }
?>