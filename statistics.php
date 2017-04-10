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
        <div id="header">UE College of Law Election <?php echo date('Y'); ?></div>
        <div id="content">
            <div id="sub-header">Dashboard</div>
            <div id="side-bar">
                <ul class="side-bar">
                    <li><a href="dashboard.php"><span id="home-icon" class="side-bar-icon"></span>Home</a></li>
                    <li><a href="registration.php"><span id="voter-registration-icon" class="side-bar-icon"></span>Voter Registration</a></li>
                    <li><a href="reset.php"><span id="voter-reset-icon" class="side-bar-icon"></span>Voter Reset</a></li>
                    <li><a href="results.php"><span id="election-results-icon" class="side-bar-icon"></span>Election Results</a></li>
                    <li><a href="statistics.php"><span id="statistics-icon" class="side-bar-icon"></span>Statistics</a></li>
                    <?php
                        if($_SESSION['user_type'] == 'Master Administrator') {
                            echo '<li><a href="configurations.php"><span id="configurations-icon" class="side-bar-icon"></span>Configurations</a></li>';
                        }
                    ?>
                    <li><a href="admin.php"><span id="logout-icon" class="side-bar-icon"></span>Logout</a></li>
                </ul>
            </div>
            <div id="container">
                <div class="statistics">
                    <div class="stat shadow">
                        <div>Total Voters:</div>
                        <div id="total" class="total align-center"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
    <script>
        setInterval(function() {
            $.ajax({
                url: 'requests/total_voters.php',
                method: 'GET',
                success: function(response) {
                    $('#total.total').html(response);
                }
            });

            return false;
        }, 1000);
    </script>
</body>
</html>