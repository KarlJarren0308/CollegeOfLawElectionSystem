<?php
    require('requests/mods.php');

    $mods = new Mods();

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'Voter') {
        header('Location: dashboard.php');
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
    <script src="assets/js/script.js"></script>
</head>
<body id="main-body">
    <div id="main-block" class="shadow">
        <div id="header">UE College of Law Election <?php echo date('Y'); ?></div>
        <div id="content">
            <div id="sub-header">Voter Login</div>
            <div id="side-bar" style="padding: 0 25px; width: 200px;">
                <form class="form" method="POST" action="requests/login_request.php" style="margin-top: 65%;">
                    <input type="hidden" name="action" value="827bdf30271a01cce1ba1bedae40b4e5">
                    <label>Student Number:</label>
                    <input class="input-box focused-input" type="text" name="studentNumber" maxlength="11" required>
                    <input class="input-button" type="submit" value="Login">
                </form>
            </div>
            <div id="container">
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
    <div class="special">
        <?php
            if(isset($_POST['status'])) {
                $status = $_POST['status'];

                switch($status) {
                    case $mods->getError(0):
                        $mods->showDialog('prompt', 'Login Status', 'You may now start voting.', 'precinct.php');
                        break;
                    case $mods->getError(1):
                        $mods->showDialog('prompt', 'Login Status', 'You\'re not logged in or session has expired. Please login to continue.');
                        break;
                    case $mods->getError(2):
                        $mods->showDialog('prompt', 'Login Status', 'Voter not found.');
                        break;
                    case $mods->getError(3):
                        $mods->showDialog('prompt', 'Login Status', 'Voter not registered.');
                        break;
                    case $mods->getError(4):
                        $mods->showDialog('prompt', 'System Error', 'Voter has already voted.');
                        break;
                    case $mods->getError(5):
                        $mods->showDialog('prompt', 'System Error', 'The system failed to record your vote. Please login to continue.');
                        break;
                    case $mods->getError(7):
                        $mods->showDialog('prompt', 'Login Status', 'Voters are not allowed to access the system\'s dashboard.');
                        break;
                    default:
                        break;
                }
            } else if(isset($_POST['output'])) {
                $output = $_POST['output'];

                switch($output) {
                    case '20c1e9da750353cf0cba49283c17f8a7':
                        $mods->showDialog('prompt', 'Voting Status', 'Your vote has been successfully recorded. Thank you for voting!', 'precinct.php');
                        break;
                    default:
                        break;
                }
            } else {
                $mods->logout();
            }
        ?>
    </div>
</body>
</html>