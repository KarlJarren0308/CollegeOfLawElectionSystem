<?php
    require('mods.php');
    require('election.php');

    $mods = new Mods();
    $mods->startConnection();
    $election = new Election();
    $election->startReading('candidates');

    $action = $mods->escapeString($_POST['action']);

    if($action = $mods->getAction(5)) {
        $position = $mods->escapeString($_POST['position']);
        $election->connectNow();
        echo $election->showVotes($position);
    }

    $mods->stopConnection();
?>