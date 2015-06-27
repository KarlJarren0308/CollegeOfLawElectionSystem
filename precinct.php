<?php
    require('requests/mods.php');

    $mods = new Mods();
    $mods->startConnection();

    if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Voter')) {
        $mods->sendStatus($mods->getError(1));
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
    <script src="assets/js/precinct.js"></script>
</head>
<body id="main-body">
    <div id="main-block" class="shadow">
        <div id="header">UE College of Law Election <?php echo date('Y'); ?></div>
        <div id="content">
            <div id="sub-header"></div>
            <div id="side-bar">
                <a id="scroll-up" href="javascript:void(0);" style="display: none;"><span class="fa fa-chevron-up"></span></a>
                <a id="scroll-down" href="javascript:void(0);"><span class="fa fa-chevron-down"></span></a>
                <div id="side-bar-container">
                    <img id="image-president" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-vice-president" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-secretary" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-treasurer" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-auditor" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-business-manager" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-4th-year-rep" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-3rd-year-rep" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-2nd-year-rep" class="image" src="images/warrior.png" draggable="false">
                    <img id="image-1st-year-rep" class="image" src="images/warrior.png" draggable="false">
                </div>
            </div>
            <div id="container">
                <div class="candidates">
                </div>
                <div class="controls">
                    <button id="prev-button" class="input-button">Prev</button>
                    <button id="next-button" class="input-button">Next</button>
                    <button id="submit-button" class="input-button">Submit</button>
                </div>
                <form data-form="votes-form" method="POST" action="requests/candidates.php">
                    <input type="hidden" name="action" value="852cd102433d4f064066bf6413989d12">
                    <input type="hidden" id="voted-president" name="votes[]">
                    <input type="hidden" id="voted-vice-president" name="votes[]">
                    <input type="hidden" id="voted-secretary" name="votes[]">
                    <input type="hidden" id="voted-treasurer" name="votes[]">
                    <input type="hidden" id="voted-auditor" name="votes[]">
                    <input type="hidden" id="voted-business-manager" name="votes[]">
                    <input type="hidden" id="voted-4th-year-rep" name="votes[]">
                    <input type="hidden" id="voted-3rd-year-rep" name="votes[]">
                    <input type="hidden" id="voted-2nd-year-rep" name="votes[]">
                    <input type="hidden" id="voted-1st-year-rep" name="votes[]">
                </form>
            </div>
        </div>
        <div id="footer">© Copyright <?php echo date('Y'); ?> UE-CCSS Research & Development Unit 2013</div>
    </div>
</body>
</html>