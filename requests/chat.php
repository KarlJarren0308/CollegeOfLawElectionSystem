<?php
    class Chat {
        private $connection;
        private $query;
        private $hostname = 'localhost';
        private $username = 'root';
        private $password = '';
        private $databasename = 'law_election_database';

        function __construct() {
            date_default_timezone_set('Asia/Manila');

            $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->databasename);
        }

        function setQuery($sql) {
            $this->query = mysqli_query($this->connection, $sql) or die('Failed to connect to Database. Error: Chat::setQuery() method.');
        }

        function getMessages($type = 'array') {
            if($type == 'array') {
                return mysqli_fetch_array($this->query);
            } else if($type == 'assoc') {
                return mysqli_fetch_assoc($this->query);
            } else {
                return false;
            }
        }

        function getMessagesCount() {
            return mysqli_affected_rows($this->connection);
        }

        function escapeString($text = '') {
            return mysqli_real_escape_string($this->connection, $text);
        }

        function leaveChat() {
            mysqli_close($this->connection);
        }
    }
?>