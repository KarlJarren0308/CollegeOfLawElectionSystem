<?php
    require('requests/election.php');

    $election = new Election();
    $election->startReading('candidates');

    $test = $election->getCandidateInfo();

    foreach($test as $asd) {
        echo '<strong>' . $asd['position'] . '</strong><br>';
        foreach($asd as $qwe) {
            echo $qwe . '<br>';
        }
    }
?>