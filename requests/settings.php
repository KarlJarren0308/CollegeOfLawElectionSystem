<?php
    require('mods.php');

    if(!file_exists(__DIR__ . '/../assets/xml/settings.xml')) {
        $newXml = fopen(__DIR__ . '/../assets/xml/settings.xml', 'w');
        fwrite($newXml, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
        fwrite($newXml, '<settings><setting name="hostname" value="localhost"/><setting name="username" value="root"/><setting name="password" value=""/><setting name="database" value="law_election_database"/><setting name="status" value="3"/></settings>');
        fclose($newXml);
    }

    $mods = new Mods();
    $mods->startConnection();
    $action = $mods->escapeString($_POST['action']);

    if($action == '03a66ac2fcff279daee5381e88a153ce') {
        // Modify System Status
        $name = $mods->escapeString($_POST['name']);
        $value = $mods->escapeString($_POST['value']);

        $mods->modifySettings($name, $value);
    } else if($action == 'd639df32d0594c7f8d91949ce367a9b1') {
        // Modify Database Settings
        $hostname = $mods->escapeString($_POST['hostname']);
        $username = $mods->escapeString($_POST['username']);
        $password = $mods->escapeString($_POST['password']);
        $database = $mods->escapeString($_POST['database']);

        $mods->modifySettings('hostname', $hostname);
        $mods->modifySettings('username', $username);
        $mods->modifySettings('password', $password);
        $mods->modifySettings('database', $database);

        echo 'Saved Changes.';
    } else if($action == 'dee3906666c987ddc8d7d4162de73b79') {
        // Get System Status
        switch($mods->checkSystemSettings('status')) {
            case 1:
                echo 'The election has been <span id="election-status">started</span>.';
                break;
            case 2:
                echo 'The election has been <span id="election-status">paused</span>.';
                break;
            case 3:
                echo 'The election has been <span id="election-status">stopped</span>.';
                break;
            default:
                echo 'Oops! Something\'s wrong with the system status.';
                break;
        }
    } else if($action == 'c822c4b90e5af3183c3f4b6b9d4ee923') {
        // Get Settings
        $names = array('hostname', 'username', 'password', 'database');
        $first = true;

        echo '{';
        foreach($names as $name) {
            if($first) {
                echo '"' . $name . '": "' . $mods->checkSystemSettings($name) . '"';
                $first = false;
            } else {
                echo ', "' . $name . '": "' . $mods->checkSystemSettings($name) . '"';
            }
        }
        echo '}';
    } else if($action == '4bf9470e08c49d6a2f21061be0fa075e') {
        // Get Party List
        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

        echo '<li align="right" style="margin-bottom: 15px;"><a data-add-party href="javascript:void(0);"><span class="fa fa-plus"></span> Add new party</a></li>';

        foreach($xml->party as $party) {
            echo '<li><a data-party="' . $party['name'] . '" href="javascript:void(0);">' . $party['name'] . '</a><a class="right-button" style="border-bottom: none; float: right; position: relative;" title="Delete" data-remove-party="' . $party['name'] . '"><span class="fa fa-close"></span></a></li>';
        }
    } else if($action == '118847e23fd5212c65a4c9acfeab3b67') {
        // Get Party Add Form
        echo '<form id="add-party-form">';
        echo '<label>Party:</label><br>';
        echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 98%; margin-bottom: 1%; margin-right: 1%;" name="party" placeholder="Name of Party" autofocus>';
        echo '<input type="submit" class="input-button minify" style="color: white; margin-top: 5px;" value="Add Party">';
        echo '</form>';
    } else if($action == '418367f06b5e815a83792d394d4596d7') {
        // Get Party Edit Form
        $party = $mods->escapeString($_POST['party']);

        echo '<form id="edit-party-form">';
        echo '<input type="hidden" name="oldParty" value="' . $party . '">';
        echo '<label>Party:</label><br>';
        echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 98%; margin-bottom: 1%; margin-right: 1%;" name="newParty" placeholder="Name of Party" value="' . $party . '" autofocus>';
        echo '<input type="submit" class="input-button minify" style="color: white; margin-top: 5px;" value="Save Changes">';
        echo '</form>';
    } else if($action == '25cb56b003b48e4e428202cc62042139') {
        // Add New Party
        $party = $mods->escapeString($_POST['party']);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

        $newParty = $xml->addChild('party');
        $newParty->addAttribute('name', $party);

        if($xml->asXML(__DIR__ . '/../assets/xml/parties.xml')) {
            echo 'Saved Changes.';
        } else {
            echo 'Failed to save changes.';
        }
    } else if($action == 'c96f2cae42ea1a2521b04b14bf6cd3b5') {
        // Save Old Party
        $oldParty = $mods->escapeString($_POST['oldParty']);
        $newParty = $mods->escapeString($_POST['newParty']);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

        foreach($xml->party as $party) {
            if($party['name'] == $oldParty) {
                $party['name'] = $newParty;
            }
        }

        if($xml->asXML(__DIR__ . '/../assets/xml/parties.xml')) {
            echo 'Saved Changes.';
        } else {
            echo 'Failed to save changes.';
        }
    } else if($action == '7895fd6c3b57178f1a6fee21174197b1') {
        // Remove Party
        $deleteParty = $mods->escapeString($_POST['party']);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

        for($i = 0; $i < $xml->count(); $i++) {
            if($xml->party[$i]['name'] == $deleteParty) {
                unset($xml->party[$i]);
            }
        }

        if($xml->asXML(__DIR__ . '/../assets/xml/parties.xml')) {
            echo 'Party has been removed.';
        } else {
            echo 'Failed to remove party.';
        }
    } else if($action == '03e844f44b581835d307877c455b207f') {
        // Get Candidate List
        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');

        echo '<li align="right" style="margin-bottom: 15px;"><a data-add-candidate href="javascript:void(0);"><span class="fa fa-plus"></span> Add new candidate</a></li>';

        foreach($xml->candidate as $candidate) {
            if(strlen($candidate['middleinitial']) == 1) {
                $name = $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '. ' . $candidate['lastname'];
            } else {
                $name = $candidate['firstname'] . ' ' . $candidate['lastname'];
            }

            echo '<li><a data-candidate="' . $candidate['id'] . '" href="javascript:void(0);">' . $name . '</a><a class="right-button" style="border-bottom: none; float: right; position: relative;" title="Delete" data-remove-candidate="' . $candidate['id'] . '"><span class="fa fa-close"></span></a></li>';
        }
    } else if($action == 'cfb690cd9bbba317440e769fa9dda774') {
        // Get Candidate Add Form
        $positions = array('President', 'Vice President', 'Secretary', 'Treasurer', 'Auditor', 'Business Manager', 'P.R.O.', '4th Year Representative', '3rd Year Representative', '2nd Year Representative', '1st Year Representative');

        echo '<form id="add-candidate-form">';
        echo '<label>Candidate Information:</label><br>';
        echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateFirstName" placeholder="First Name" required autofocus>';
        echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateMiddleInitial" placeholder="Middle Initial" maxlength="1">';
        echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateLastName" placeholder="Last Name" required>';
        echo '<select class="input-box left" style="box-sizing: border-box; width: 98%; margin-bottom: 1%; margin-right: 1%;" name="candidatePosition" required>';
        echo '<option value="" selected disabled>Position</option>';
        
        foreach($positions as $pos) {
            if($pos == $candidate['position']) {
                echo '<option value="' . $pos . '" selected>' . $pos . '</option>';
            } else {
                echo '<option value="' . $pos . '">' . $pos . '</option>';
            }
        }

        echo '</select>';
        echo '<select class="input-box left" style="box-sizing: border-box; width: 65%; margin-bottom: 1%; margin-right: 1%;" name="candidateParty">';
        echo '<option value="" selected disabled>Party</option>';
        
        $xmlParty = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

        foreach($xmlParty->party as $party) {
            echo '<option value="' . $party['name'] . '">' . $party['name'] . '</option>';
        }

        echo '</select>';
        echo '<select class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateYearLevel" required>';
        echo '<option value="" selected disabled>Year Level</option>';
        echo '<option value="1">1st Year</option>';
        echo '<option value="2">2nd Year</option>';
        echo '<option value="3">3rd Year</option>';
        echo '<option value="4">4th Year</option>';
        echo '</select>';
        echo '<input type="submit" class="input-button minify" style="color: white; margin-top: 5px;" value="Add Party">';
        echo '</form>';
    } else if($action == 'fbebc45c125f74c4ccbb156bc9a24905') {
        // Get Candidate Edit Form
        $positions = array('President', 'Vice President', 'Secretary', 'Treasurer', 'Auditor', 'Business Manager', 'P.R.O.', '4th Year Representative', '3rd Year Representative', '2nd Year Representative', '1st Year Representative');
        $id = $mods->escapeString($_POST['id']);
        $xmlCandidate = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');

        foreach($xmlCandidate->candidate as $candidate) {
            if($candidate['id'] == $id) {
                echo '<form id="edit-candidate-form">';
                echo '<label>Candidate Information:</label><br>';
                echo '<input type="hidden" name="candidateID" value="' . $candidate['id'] . '">';
                echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateFirstName" placeholder="First Name" value="' . $candidate['firstname'] . '" required autofocus>';
                echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateMiddleInitial" placeholder="Middle Initial" value="' . $candidate['middleinitial'] . '" maxlength="1">';
                echo '<input type="text" class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateLastName" placeholder="Last Name" value="' . $candidate['lastname'] . '" required>';
                echo '<select class="input-box left" style="box-sizing: border-box; width: 98%; margin-bottom: 1%; margin-right: 1%;" name="candidatePosition" required>';
                echo '<option value="" disabled>Position</option>';

                foreach($positions as $pos) {
                    if($pos == $candidate['position']) {
                        echo '<option value="' . $pos . '" selected>' . $pos . '</option>';
                    } else {
                        echo '<option value="' . $pos . '">' . $pos . '</option>';
                    }
                }

                echo '</select>';
                echo '<select class="input-box left" style="box-sizing: border-box; width: 65%; margin-bottom: 1%; margin-right: 1%;" name="candidateParty" required>';
                echo '<option value="" disabled>Party</option>';
                
                $xmlParty = simplexml_load_file(__DIR__ . '/../assets/xml/parties.xml');

                foreach($xmlParty->party as $party) {
                    if((string) $party['name'] == (string) $candidate['party']) {
                        echo '<option value="' . $party['name'] . '" selected>' . $party['name'] . '</option>';
                    } else {
                        echo '<option value="' . $party['name'] . '">' . $party['name'] . '</option>';
                    }
                }

                echo '</select>';
                echo '<select class="input-box left" style="box-sizing: border-box; width: 32%; margin-bottom: 1%; margin-right: 1%;" name="candidateYearLevel" required>';
                echo '<option value="" disabled>Year Level</option>';
                echo '<option value="1"' . ($candidate['year'] == 1 ? ' selected' : '') . '>1st Year</option>';
                echo '<option value="2"' . ($candidate['year'] == 2 ? ' selected' : '') . '>2nd Year</option>';
                echo '<option value="3"' . ($candidate['year'] == 3 ? ' selected' : '') . '>3rd Year</option>';
                echo '<option value="4"' . ($candidate['year'] == 4 ? ' selected' : '') . '>4th Year</option>';
                echo '</select>';
                echo '<input type="submit" class="input-button minify" style="color: white; margin-top: 5px;" value="Save Changes">';
                echo '</form>';
            }
        }
    } else if($action == 'e97d895f04a8ca16911bd1b57b7e0887') {
        // Add New Candidate
        $candidateFirstName = $mods->escapeString($_POST['candidateFirstName']);
        $candidateMiddleInitial = $mods->escapeString($_POST['candidateMiddleInitial']);
        $candidateLastName = $mods->escapeString($_POST['candidateLastName']);
        $candidatePosition = $mods->escapeString($_POST['candidatePosition']);
        $candidateParty = $mods->escapeString($_POST['candidateParty']);
        $candidateYearLevel = $mods->escapeString($_POST['candidateYearLevel']);

        $id = date('y') . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');

        $newCandidate = $xml->addChild('candidate');
        $newCandidate->addAttribute('id', $id);
        $newCandidate->addAttribute('lastname', $candidateLastName);
        $newCandidate->addAttribute('firstname', $candidateFirstName);
        $newCandidate->addAttribute('middleinitial', $candidateMiddleInitial);
        $newCandidate->addAttribute('position', $candidatePosition);
        $newCandidate->addAttribute('party', $candidateParty);
        $newCandidate->addAttribute('year', $candidateYearLevel);

        if($xml->asXML(__DIR__ . '/../assets/xml/candidates.xml')) {
            echo 'Saved Changes.';
        } else {
            echo 'Failed to save changes.';
        }
    } else if($action == 'a305c4539e938faa06f1f369c8753c1d') {
        // Save Old Candidate
        $candidateID = $mods->escapeString($_POST['candidateID']);
        $candidateFirstName = $mods->escapeString($_POST['candidateFirstName']);
        $candidateMiddleInitial = $mods->escapeString($_POST['candidateMiddleInitial']);
        $candidateLastName = $mods->escapeString($_POST['candidateLastName']);
        $candidatePosition = $mods->escapeString($_POST['candidatePosition']);
        $candidateParty = $mods->escapeString($_POST['candidateParty']);
        $candidateYearLevel = $mods->escapeString($_POST['candidateYearLevel']);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');

        foreach($xml->candidate as $candidate) {
            if($candidate['id'] == $candidateID) {
                $candidate['firstname'] = $candidateFirstName;
                $candidate['middleinitial'] = $candidateMiddleInitial;
                $candidate['lastname'] = $candidateLastName;
                $candidate['position'] = $candidatePosition;
                $candidate['party'] = $candidateParty;
                $candidate['year'] = $candidateYearLevel;
            }
        }

        if($xml->asXML(__DIR__ . '/../assets/xml/candidates.xml')) {
            echo 'Saved Changes.';
        } else {
            echo 'Failed to save changes.';
        }
    } else if($action == '173e37e4d03ef74196b28688770c6822') {
        // Remove Candidate
        $deleteCandidate = $mods->escapeString($_POST['candidate']);

        $xml = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');

        for($i = 0; $i < $xml->count(); $i++) {
            if($xml->candidate[$i]['id'] == $deleteCandidate) {
                unset($xml->candidate[$i]);
            }
        }

        if($xml->asXML(__DIR__ . '/../assets/xml/candidates.xml')) {
            echo 'Candidate has been removed.';
        } else {
            echo 'Failed to remove Candidate.';
        }
    } else if($action == '1f6d2bc8ff9d746760a20ff5c4bc4c6d') {
        // Get Voters List
        $mods->setQuery("SELECT * FROM voters");

        echo '<li align="right" style="margin-bottom: 15px;"><a data-add-voter href="javascript:void(0);"><span class="fa fa-plus"></span> Add new voter</a></li>';

        while($row = $mods->getResults('array')) {
            echo '<li><a data-voter="' . $row['Voter_ID'] . '" href="javascript:void(0);">' . $row['Voter_ID'] . '</a><a class="right-button" style="border-bottom: none; float: right; position: relative;" title="Delete" data-remove-voter="' . $row['Voter_ID'] . '"><span class="fa fa-close"></span></a></li>';
        }
    } else {
        if($action == '' or $action == null) {
            echo 'No action has been specified.';
        } else {
            echo 'Invalid Action.';
        }
    }
?>