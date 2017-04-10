<?php
    require('mods.php');
    require('election.php');

    $mods = new Mods();
    $mods->startConnection();
    $action = $mods->escapeString($_POST['action']);

    if($action == $mods->getAction(1)) {
        if($mods->checkSystemSettings('status') == '2') {
            $mods->sendStatus($mods->getError(9), '../index.php');
        } else if($mods->checkSystemSettings('status') == '3') {
            $mods->sendStatus($mods->getError(10), '../index.php');
        } else {
            $studentNumber = $mods->escapeString($_POST['studentNumber']);
            $mods->setQuery("SELECT * FROM voters WHERE Voter_ID='$studentNumber'");

            if($mods->getCount() == 1) {
                $row = $mods->getResults('array');

                if($row['Status'] == 1) {
                    $mods->login($studentNumber, 'Voter', $row['Year_Level']);

                    $mods->sendStatus($mods->getError(0), '../index.php');
                } else if($row['Status'] == 0) {
                    $mods->sendStatus($mods->getError(3), '../index.php');
                } else if($row['Status'] == 2) {
                    $mods->sendStatus($mods->getError(4), '../index.php');
                }
            } else {
                $mods->sendStatus($mods->getError(2), '../index.php');
            }
        }
    } else if($action == $mods->getAction(2)) {
        $username = $mods->escapeString($_POST['username']);
        $password = $mods->escapeString($_POST['password']);

        $election = new Election();
        $xml = $election->startReading('accounts');

        if($election->checkAccount($username, md5($password)) != false) {
            $type = (string) $election->checkAccount($username, md5($password));
            
            $mods->login($username, $type);
            $mods->sendStatus($mods->getError(0), '../admin.php');
        } else {
            $mods->sendStatus($mods->getError(6), '../admin.php');
        }
    }

    $mods->stopConnection();
?>