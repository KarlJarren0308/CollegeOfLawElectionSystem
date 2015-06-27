<?php
    require('requests/mods.php');

    $mods = new Mods();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UE College of Law Election System</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/admin.js"></script>
</head>
<body id="main-body">
    <div id="main-block" class="shadow">
        <div id="header">UE College of Law Election <?php echo date('Y'); ?></div>
        <div id="content">
            <div id="sub-header">Administrative Login</div>
            <div id="side-bar" style="padding: 0 25px; width: 200px;">
                <form class="form" method="POST" action="requests/login_request.php" style="margin-top: 65%;">
                    <input type="hidden" name="action" value="b6e31daf2404aab3d78c7e972dfe3f8d">
                    <label>Username:</label>
                    <input class="input-box focused-input" type="text" name="username" maxlength="11" required>
                    <label>Password:</label>
                    <input class="input-box" type="password" name="password" maxlength="11" required>
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
                        $mods->showDialog('prompt', 'Login Status', 'You will now be redirected to the Dashboard.', 'dashboard.php');
                        break;
                    case $mods->getError(1):
                        $mods->showDialog('prompt', 'Login Status', 'You\'re not logged in or session has expired. Please login to continue.');
                        break;
                    case $mods->getError(6):
                        $mods->showDialog('prompt', 'Login Status', 'Account doesn\'t exist.');
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