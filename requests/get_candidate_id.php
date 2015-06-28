<?php
    if(!file_exists(__DIR__ . '/../assets/xml/candidates.xml')) {
        $newXml = fopen(__DIR__ . '/../assets/xml/candidates.xml', 'w');
        fwrite($newXml, '');
        fclose($newXml);
    }

    $xml = simplexml_load_file(__DIR__ . '/../assets/xml/candidates.xml');
    $first = true;

    echo '[';
    foreach($xml as $candidate) {
        if($first) {
            echo '{"position": "' . $candidate['position'] . '", "id": "' . $candidate['id'] . '"}';
            $first = false;
        } else {
            echo ', {"position": "' . $candidate['position'] . '", "id": "' . $candidate['id'] . '"}';
        }
    }
    echo ']';
?>