<?php
    class Election {
        private $xmlReader;
        private $connect;

        function startReading($xml) {
            $this->xmlReader = simplexml_load_file(__DIR__ . '/../assets/xml/' . $xml . '.xml');
        }

        function checkFile($xmlFile) {
            if(!file_exists(__DIR__ . '/../assets/xml/' . $xmlFile . '.xml')) {
                $newXml = fopen(__DIR__ . '/../assets/xml/' . $xmlFile . '.xml', 'w');
                fwrite($newXml, '');
                fclose($newXml);
            }
        }

        function checkAccount($username, $password) {
            $flag = false;

            foreach($this->xmlReader as $account) {
                if($account['username'] == $username && $account['password'] == $password) {
                    $flag = $account['type'];
                    break;
                }
            }

            return $flag;
        }

        function getCandidates($position = 'All') {
            $returnValue = '';

            if($position == 'All') {
            } else if($position == 0) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'President') {
                        $returnValue .= '<div class="candidate president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 1) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Vice President') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 2) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Secretary') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 3) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Treasurer') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 4) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Auditor') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 5) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Business Manager') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 6) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '4th Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 7) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '3rd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 8) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '2nd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 9) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '1st Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            }

            return $returnValue;
        }

        function connectNow() {
            $this->connect = mysqli_connect('localhost', 'root', '', 'law_election_database');
        }

        function getVoterCount($yearLevel = '') {
            if($yearLevel == '') {
                $sql = "SELECT * FROM voters";
            } else {
                $sql = "SELECT * FROM voters WHERE Year_Level='$yearLevel'";
            }

            $query = mysqli_query($this->connect, $sql);

            return mysqli_num_rows($query);
        }

        function getVoteCount($candidateID) {
            $query = mysqli_query($this->connect, "SELECT * FROM votes WHERE Candidate_ID='$candidateID'");

            return mysqli_num_rows($query);
        }

        function showVotes($position = 'All') {
            $returnValue = '';

            if($position == 'All') {
            } else if($position == 0) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'President') {
                        $returnValue .= '<div class="candidate president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 1) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Vice President') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 2) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Secretary') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 3) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Treasurer') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 4) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Auditor') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 5) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Business Manager') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 6) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '4th Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 7) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '3rd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 8) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '2nd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 9) {
                foreach($this->xmlReader as $candidate) {
                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '1st Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $candidate['id'] . '.jpg" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            }

            return $returnValue;
        }
    }
?>