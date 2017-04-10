<?php
    require('requests/mods.php');
    require('requests/chat.php');

    $mods = new Mods();

    if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_type']))) {
        $mods->sendStatus($mods->getError(1), 'admin.php');
    } else {
        if($_SESSION['user_type'] == 'Voter') {
            $mods->sendStatus($mods->getError(7), 'index.php');
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UE College of Law Election System</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
</head>
<body id="main-body">
    <div id="main-block" class="shadow">
        <div id="header">UE College of Law Election <?php echo date('Y'); ?><a href="dashboard.php" class="floating-button" style="right: 10px;" title="Dashboard"><span class="fa fa-home"></span></a></div>
        <div id="content">
            <div id="sub-header">Voter Registration</div>
            <div id="side-bar" style="padding: 0 25px; width: 200px;">
                <form class="form" method="POST" action="" style="margin-top: 65%;">
                    <label>Student Number:</label>
                    <input class="input-box focused-input" type="text" name="studentNumber" maxlength="11" required autofocus>
                    <input class="input-button" type="submit" value="Register">
                </form>
            </div>
            <div id="container">
                <div id="msg">
                    <?php
                        if(isset($_POST['studentNumber'])) {
                            $mods->startConnection();

                            $studentNumber = $mods->escapeString($_POST['studentNumber']);

                            $mods->setQuery("SELECT * FROM voters WHERE Voter_ID='$studentNumber'");

                            if($mods->getCount() == 1) {
                                $row = $mods->getResults('array');

                                if($row['Status'] == 0) {
                                    // update status here
                                    $mods->setQuery("UPDATE voters SET Status=1 WHERE Voter_ID='$studentNumber'");

                                    if($mods->getCount() > 0) {
                                        echo '<img class="icon" src="assets/img/check-mark.png" alt="icon">&nbsp;&nbsp;<span>Voter has been registered.</span>';
                                    } else {
                                        echo '<img class="icon" src="assets/img/cross-mark.png" alt="icon">&nbsp;&nbsp;<span>Failed to register voter.</span>';
                                    }
                                } else if($row['Status'] == 1) {
                                    echo '<img class="icon" src="assets/img/exclamation-mark.png" alt="icon">&nbsp;&nbsp;<span>Voter is already registered.</span>';
                                } else if($row['Status'] == 2) {
                                    echo '<img class="icon" src="assets/img/exclamation-mark.png" alt="icon">&nbsp;&nbsp;<span>Voter has already voted.</span>';
                                } else {
                                    echo '<img class="icon" src="assets/img/exclamation-mark.png" alt="icon">&nbsp;&nbsp;<span>Oops! Something\'s wrong with the User\'s Information.</span>';
                                }
                            } else {
                                if(is_numeric($studentNumber)) {
                                    echo '<img class="icon" src="assets/img/cross-mark.png" alt="icon">&nbsp;&nbsp;<span>Voter not found.</span>';
                                } else {
                                    echo '<img class="icon" src="assets/img/cross-mark.png" alt="icon">&nbsp;&nbsp;<span>Invalid input. Please try again.</span>';
                                }
                            }

                            echo '<script>setTimeout(function() { window.location="registration.php"; }, 3000);</script>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
</body>
</html>