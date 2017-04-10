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
    <script src="assets/js/configurations.js"></script>
</head>
<body id="main-body">
    <div id="main-block" class="shadow">
        <div id="header">UE College of Law Election <?php echo date('Y'); ?><a href="dashboard.php" class="floating-button" style="right: 10px;" title="Dashboard"><span class="fa fa-home"></span></a></div>
        <div id="content">
            <div id="sub-header">Configurations</div>
            <div id="side-bar">
                <ul class="side-bar no-padding">
                    <li><a id="voters-menu-item" href="javascript:void(0);">Voters</a></li>
                    <li><a id="candidates-menu-item" href="javascript:void(0);">Candidates</a></li>
                    <li><a id="parties-menu-item" href="javascript:void(0);">Parties</a></li>
                    <li><a id="database-settings-menu-item" href="javascript:void(0);">Database Settings</a></li>
                    <li><a id="system-settings-menu-item" href="javascript:void(0);">System Settings</a></li>
                </ul>
            </div>
            <div id="container">
                <div id="panel" class="panel"></div>
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
</body>
</html>