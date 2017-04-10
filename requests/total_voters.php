<?php
    require('mods.php');

    $mods = new Mods();
    $mods->startConnection();
    $mods->setQuery("SELECT * FROM voters");
    $denominator = $mods->getCount();

    $mods->setQuery("SELECT * FROM voters WHERE Status='2'");
    $numerator = $mods->getCount();

    echo $numerator . '/' . $denominator;
?>