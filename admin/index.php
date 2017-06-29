<?php ob_start();
    include_once("../functions.php");
    session_start();
    if(check_login()){

        header("Location: admin-dashboard.php");
        ob_end_flush();
        exit();
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="uts-8" />
        <title>Admin | Login</title>
        <meta  name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="../css/css-admin/index.css"/>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">

        <script type="text/javascript" src="../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $("#textfield-username").focus();
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="container">
                    <div class="header-top">
                        <h1 class="logo-text">KATHMANDU ELECTRONICS</h1>
                    </div>
                </div>
            </div>
            <main>
                <div class="container">
                    <h2 class="section-header">Login</h2>
                    <form id="login-form" action="" method="POST">
                        <p>
                            <label for="textfield-username">Username</label>
                            <input id="textfield-username" type="text" name="username" value=""/>
                        </p>
                        <p>
                            <label for="textfield-password">Password</label>
                            <input id="textfield-password" type="password" name="pwd" value=""/>
                        </p>
                        <p>
                            <input id="login-button" type="submit" name="submit" value="Login"/>
                        </p>
                        <?php if(isset($_POST["submit"])){attempt_login();} ?>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>