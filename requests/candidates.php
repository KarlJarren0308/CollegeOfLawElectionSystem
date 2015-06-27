<?php
    require('mods.php');
    require('election.php');

    $election = new Election();
    $mods = new Mods();
    $mods->startConnection();
    $action = $mods->escapeString($_POST['action']);

    if($action == $mods->getAction(3)) {
        $position = $mods->escapeString($_POST['position']);

        $election->startReading('candidates');
        echo $election->getCandidates($position);
    } else if($action == $mods->getAction(4)) {
        $sessionID = $mods->getSession('user_id');

        $mods->setQuery("SELECT * FROM voters WHERE Voter_ID='$sessionID'");
        $row = $mods->getResults('array');

        if($row['Status'] == 0) {
            echo 'Voter not registered.';
        } else if($row['Status'] == 1) {
            $ctr = 0;

            foreach($_POST['votes'] as $vote) {
                if($vote != '') {
                    $mods->setQuery("INSERT INTO votes (Voter_ID, Candidate_ID) VALUES ('$sessionID', '$vote')");

                    if($mods->getCount() > 0) {
                        $ctr++;
                    }
                }
            }

            if($ctr > 0) {
                $mods->setQuery("UPDATE voters SET Status=2 WHERE Voter_ID='$sessionID'");

                if($mods->getCount() == 1) {
                    $mods->sendStatus('20c1e9da750353cf0cba49283c17f8a7', '../index.php', 'output');
                }
            } else {
                $mods->sendStatus($mods->getError(5), '../index.php');
            }
        } else if($row['Status'] == 2) {
            echo 'Voter already voted.';
        } else {
            echo 'Oops! There\'s something wrong with the voter\'s information.';
        }
    }

    $mods->stopConnection();
?>