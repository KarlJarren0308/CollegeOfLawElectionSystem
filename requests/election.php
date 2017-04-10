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

        function getCandidates($position = '') {
            $returnValue = '';

            if($position == 0) {
                foreach($this->xmlReader as $candidate) {
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'President') {
                        $returnValue .= '<div class="candidate president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Vice President') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Secretary') {
                        $returnValue .= '<div class="candidate secretary">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Treasurer') {
                        $returnValue .= '<div class="candidate treasurer">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Auditor') {
                        $returnValue .= '<div class="candidate auditor">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Business Manager') {
                        $returnValue .= '<div class="candidate business-manager">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'P.R.O.') {
                        $returnValue .= '<div class="candidate pro">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '4th Year Representative') {
                        $returnValue .= '<div class="candidate 4th-year-rep">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '3rd Year Representative') {
                        $returnValue .= '<div class="candidate 3rd-year-rep">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '2nd Year Representative') {
                        $returnValue .= '<div class="candidate 2nd-year-rep">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="candidate-party-list">' . $candidate['party'] . '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 10) {
                foreach($this->xmlReader as $candidate) {if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '1st Year Representative') {
                        $returnValue .= '<div class="candidate 1st-year-rep">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                $sql = "SELECT * FROM voters WHERE Status='2'";
            } else {
                $sql = "SELECT * FROM voters WHERE Status='2' AND Year_Level='$yearLevel'";
            }

            $query = mysqli_query($this->connect, $sql);

            return mysqli_num_rows($query);
        }

        function getVoteCountPerYearLevel($candidateID, $yearLevel) {
            $query = mysqli_query($this->connect, "SELECT * FROM votes INNER JOIN voters ON votes.Voter_ID=voters.Voter_ID WHERE voters.Status='2' AND voters.Year_Level='$yearLevel' AND votes.Candidate_ID='$candidateID'");

            return mysqli_num_rows($query);
        }

        function getVoteCount($candidateID) {
            $query = mysqli_query($this->connect, "SELECT * FROM votes WHERE Candidate_ID='$candidateID'");

            return mysqli_num_rows($query);
        }

        function getCandidateInfo() {
            $returnValue = array();
            $first = true;

            foreach($this->xmlReader->candidate as $key => $account) {
                if($first) {
                    // $returnValue .= json_encode($account);
                    // $returnValue .= '["' . $account['position'] . '", "' . $account['id'] . '", "' . $account['firstname'] . '", "' . $account['middleinitial'] . '", "' . $account['lastname'] . '", "' . $account['year'] . '", "' . $account['party'] . '"]';
                    $first = false;
                } else {
                    // $returnValue .= ', ' . json_encode($account);
                    // $returnValue .= ', ["' . $account['position'] . '", "' . $account['id'] . '", "' . $account['firstname'] . '", "' . $account['middleinitial'] . '", "' . $account['lastname'] . '", "' . $account['year'] . '", "' . $account['party'] . '"]';
                }
                array_push($returnValue, array('position' => $account['position'], 'id' => $account['id'], 'firstname' => $account['firstname'], 'middleinitial' => $account['middleinitial'], 'lastname' => $account['lastname'], 'year' => $account['year'], 'party' => $account['party']));
            }

            return $returnValue;
        }

        function showVotes($position = '') {
            $returnValue = '';

            if($position == 0) {
                foreach($this->xmlReader as $candidate) {
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'President') {
                        $returnValue .= '<div class="candidate president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Vice President') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Secretary') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Treasurer') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Auditor') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'Business Manager') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount() . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 6) {
                foreach($this->xmlReader as $candidate) {if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == 'P.R.O.') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
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
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '4th Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount(4) . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 8) {
                foreach($this->xmlReader as $candidate) {
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '3rd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount(3) . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 9) {
                foreach($this->xmlReader as $candidate) {
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '2nd Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount(2) . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                        $returnValue .= '</div>';
                    }
                }
            } else if($position == 10) {
                foreach($this->xmlReader as $candidate) {
                    if(file_exists('../images/' . $candidate['id'] . '.jpg')) {
                        $image = $candidate['id'] . '.jpg';
                    } else {
                        $image = 'warrior.png';
                    }

                    $name = strlen($candidate['middleinitial']) == 1 ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $candidate['lastname'] . ', ' . $candidate['firstname'];
                    if($candidate['position'] == '1st Year Representative') {
                        $returnValue .= '<div class="candidate vice-president">';
                        $returnValue .= '<div class="container">';
                        $returnValue .= '<img src="images/' . $image . '" class="candidate-image">';
                        $returnValue .= '<div class="candidate-info" data-candidate-id="' . $candidate['id'] . '">';
                        $returnValue .= '<div class="candidate-name">' . $name . '</div>';
                        $returnValue .= '<div class="progress-bar"><span class="count" id="count-' . $candidate['id'] . '">' . $this->getVoteCount($candidate['id']) . '/' . $this->getVoterCount(1) . '</span><span class="bar" id="bar-' . $candidate['id'] . '"></span></div>';
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