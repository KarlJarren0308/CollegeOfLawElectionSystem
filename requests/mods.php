<?php
    class Mods {
        private $connection;
        private $query;
        private $host;
        private $username;
        private $password;
        private $database;
        private $xmlReader;

        function __construct() {
            date_default_timezone_set('Asia/Manila');
            session_start();
            
            if(!file_exists(__DIR__ . '/../assets/xml/settings.xml')) {
                $newXml = fopen(__DIR__ . '/../assets/xml/settings.xml', 'w');
                fwrite($newXml, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($newXml, '<settings><setting name="hostname" value="localhost"/><setting name="username" value="root"/><setting name="password" value=""/><setting name="database" value="law_election_database"/></settings>');
                fclose($newXml);
            }

            $xml = simplexml_load_file(__DIR__ . '/../assets/xml/settings.xml');

            foreach($xml->setting as $setting) {
                if($setting['name'] == 'hostname') {
                    $this->host = $setting['value'];
                } else if($setting['name'] == 'username') {
                    $this->username = $setting['value'];
                } else if($setting['name'] == 'password') {
                    $this->password = $setting['value'];
                } else if($setting['name'] == 'database') {
                    $this->database = $setting['value'];
                }
            }
        }

        function checkConnection() {
            return $this->host . ';' . $this->username . ';' . $this->password . ';' . $this->database;
        }

        function startConnection() {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        }

        function setQuery($sql = '') {
            $this->query = mysqli_query($this->connection, $sql) or die('Failed to connect to Database.');
        }

        function getResults($type = 'array') {
            if($type == 'array') {
                return mysqli_fetch_array($this->query);
            } else if($type == 'assoc') {
                return mysqli_fetch_assoc($this->query);
            } else {
                return false;
            }
        }

        function getCount() {
            return mysqli_affected_rows($this->connection);
        }

        function stopConnection() {
            mysqli_close($this->connection);
        }

        function escapeString($text = '') {
            return mysqli_real_escape_string($this->connection, $text);
        }

        function login($username = '', $type = '') {
            if($username != '' && $type != '') {
                $_SESSION['user_id'] = $username;
                $_SESSION['user_type'] = $type;
            }
        }

        function getSession($key) {
            if(isset($_SESSION[$key])) {
                return $_SESSION[$key];
            } else {
                return 'Session not found.';
            }
        }

        function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_type']);

            session_destroy();
        }

        function getAction($num) {
            switch($num) {
                case 1:
                    return '827bdf30271a01cce1ba1bedae40b4e5'; // Voter Login
                    break;
                case 2:
                    return 'b6e31daf2404aab3d78c7e972dfe3f8d'; // Admin Login
                    break;
                case 3:
                    return 'cfb0812ce377639da10d21e6416d3a2d'; // View Candidate Info
                    break;
                case 4:
                    return '852cd102433d4f064066bf6413989d12'; // Record Votes
                    break;
                case 5:
                    return '4423e313719cbd8b2b3cc097bf3bb439'; // Count Votes
                    break;
                default:
                    return false;
                    break;
            }
        }

        function getError($num) {
            switch($num) {
                case 0:
                    return '067c5de4cdf7cc2a828955c4ea974b56'; // No error found
                    break;
                case 1:
                    return '7d644ea2d334fb5090ed8da4b333d6ea'; // Not Logged In
                    break;
                case 2:
                    return '8e9d08b1814e90846d07cd8fe0811e06'; // Voter not found
                    break;
                case 3:
                    return '7df96f61cc276e6681e49cd3171c1ec5'; // Voter not registered
                    break;
                case 4:
                    return '8149d3a5e07bb78d176a63537cc5e190'; // Voter already voted
                    break;
                case 5:
                    return '53f0d46373144b95d4052069cecf3eda'; // Failed to record vote
                    break;
                case 6:
                    return '95f9c66768b461edabdd6a690dcc60ef'; // Account doesn't exist
                    break;
                case 7:
                    return '339bac317aafce10a3ca6e3d587e8638'; // Voter accessing dashboard
                    break;
                default:
                    return false;
                    break;
            }
        }

        function showDialog($type, $title, $content, $path = '', $option = 'yes-no') {
            echo '<div class="overlay">';
            if($type == 'prompt') {
                if($path != '') {
                    echo '<div class="overlay-dialog"><div class="overlay-dialog-header">' . $title . '</div><div class="overlay-dialog-content">' . $content . '</div><div class="overlay-dialog-footer"><button class="input-button minify" data-overlay-dialog-button-value="Okay" data-redirect="' . $path . '">Okay</button></div></div>';
                } else {
                    echo '<div class="overlay-dialog"><div class="overlay-dialog-header">' . $title . '</div><div class="overlay-dialog-content">' . $content . '</div><div class="overlay-dialog-footer"><button class="input-button minify" data-overlay-dialog-button-value="Okay">Okay</button></div></div>';
                }
            } else if($type == 'option') {
                if($option == 'yes-no') {
                    echo '<div class="overlay"><div class="overlay-dialog"><div class="overlay-dialog-header">' . $title . '</div><div class="overlay-dialog-content">' . $content . '</div><div class="overlay-dialog-footer"><button class="input-button minify" data-overlay-dialog-button-focus="true">Yes</button>&nbsp;<button class="input-button minify">No</button></div></div>';
                } else if($option == 'submit-cancel') {
                    echo '<div class="overlay"><div class="overlay-dialog"><div class="overlay-dialog-header">' . $title . '</div><div class="overlay-dialog-content">' . $content . '</div><div class="overlay-dialog-footer"><button class="input-button minify" data-overlay-dialog-button-focus="true">Submit</button>&nbsp;<button class="input-button minify">Cancel</button></div></div>';
                }
            }
            echo '</div>';
            echo '<script src="assets/js/dialog.js"></script>';
        }

        function sendStatus($error, $path = 'index.php', $name = 'status') {
            echo '<html><head></head><body><form id="status-form" method="post" action="' . $path . '"><input type="hidden" name="' . $name . '" value="' . $error . '" /></form><script type="text/javascript">document.getElementById("status-form").submit();</script></body></html>';
        }
    }
?>