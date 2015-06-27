<?php
    require('chat.php');
    date_default_timezone_set('Asia/Manila');
    session_start();

    $chatApp = new Chat();
    $action = $chatApp->escapeString($_POST['action']);

    if($action == '670b6594b0d31fe3cb808084a4c9c0cb') {
        $chatApp->setQuery("SELECT * FROM logs ORDER BY Date_Time_Added");

        while($row = $chatApp->getMessages('array')) {
            if($row['Type'] == 'Chat') {
                if($row['Username'] == $_SESSION['user_id']) {
                    echo '<div class="me"><div class="name">You</div><div class="content">' . $row['Message'] . '</div><span class="arrow"></span><div class="time">' . date('F d, Y (h:i A)', strtotime($row['Date_Time_Added'])) . '</div></div>';
                } else {
                    echo '<div class="other"><div class="name">' . $row['Username'] . '</div><div class="content">' . $row['Message'] . '</div><div class="time">' . date('F d, Y (h:i A)', strtotime($row['Date_Time_Added'])) . '</div></div>';
                }
            } else if($row['Type'] == 'System Log') {
                echo '<div class="system"><div class="content">' . $row['Username'] . ' ' . $row['Message'] . '</div><div class="time">' . date('F d, Y (h:i A)', strtotime($row['Date_Time_Added'])) . '</div></div>';
            }
        }
    } else if($action == '5dd205015951f9f81e5b95c86457130a') {
        $username = $chatApp->escapeString($_POST['username']);
        $message = $chatApp->escapeString($_POST['message']);
        $datetime = date('Y-m-d H:i:s');

        $chatApp->setQuery("INSERT INTO logs (Username, Date_Time_Added, Message, Type) VALUES ('$username', '$datetime', '$message', 'Chat')");

        if($chatApp->getMessagesCount() == 1) {
            echo true;
        } else {
            echo false;
        }
    } else if($action == '0bd0904b022afac1c25776450cab3fe4') {
        $username = $chatApp->escapeString($_POST['username']);
        $message = $chatApp->escapeString($_POST['message']);
        $datetime = date('Y-m-d H:i:s');

        $chatApp->setQuery("INSERT INTO logs (Username, Date_Time_Added, Message, Type) VALUES ('$username', '$datetime', '$message', 'System Log')");

        if($chatApp->getMessagesCount() == 1) {
            echo true;
        } else {
            echo false;
        }
    }

    $chatApp->leaveChat();
?>