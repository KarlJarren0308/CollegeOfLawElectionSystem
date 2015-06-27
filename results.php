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
        <div id="header">UE College of Law Election <?php echo date('Y'); ?><a href="dashboard.php" class="floating-button" style="right: 10px;"><span class="fa fa-home"></span></a></div>
        <div id="content">
            <div id="sub-header">Election Results</div>
            <div id="side-bar" style="text-align: center; padding: 0 25px; width: 200px;">
                <select id="position" class="input-box position">
                    <option value="" class="fg-gray" disabled selected>Category</option>
                    <option value="0" class="fg-dark">President</option>
                    <option value="1" class="fg-dark">Vice President</option>
                    <option value="2" class="fg-dark">Secretary</option>
                    <option value="3" class="fg-dark">Treasurer</option>
                    <option value="4" class="fg-dark">Auditor</option>
                    <option value="5" class="fg-dark">Business Manager</option>
                    <option value="6" class="fg-dark">4th Year Representative</option>
                    <option value="7" class="fg-dark">3rd Year Representative</option>
                    <option value="8" class="fg-dark">2nd Year Representative</option>
                    <option value="9" class="fg-dark">1st Year Representative</option>
                </select>
                <button id="reveal-button" class="input-button">Reveal</button>
            </div>
            <div id="container">
                <div class="candidates">
                </div>
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
</body>
</html>