<?php session_start();



?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Ziggeraut Prime</title>
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/materialize.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="container">
           <div class="row">
               <div class="col s12 m9 login-box">
                    <h4>LOG IN</h4>
                    <div class="row">
                        <form action="" id="login-form" method="post">
                            <div class="col s12 m10 l7 input-field">
                                <input type="text" id="username" name="username" class="zpform"/>
                                <label for="username">Username</label>
                            </div>
                            <div class="col s12 m10 l7 input-field">
                                <input type="password" id="password" name="password" class="zpform"/>
                                <label for="password">Password</label>
                            </div>
                            <div class="col s12 m10 l7 right-align">
                                <input type="submit" class="waves-effect waves-light btn"></input>
                            </div>
                        </form>
                    </div>
               </div>
               <div class="col s12 m3 login-box">
                    <h4>NEED AN ACCOUNT?</h4>
                    <div class="waves-effect waves-light btn modal-trigger" data-target="signup">REGISTER</div>
                    <p></p>
               </div>
          </div>
        </div>
        <div id="signup" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="modal-header center-align">
                    <div class="container">
                        <div class="row">
                            <form action="" id="registration-form" method="post"></form>
                                <div class="col offset-m3 m6 s12">
                                    <h5>ALPHA REGISTRATION</h5>
                                    <div class="col s12 input-field">
                                        <input type="email" id="email" class="validate"/>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input type="password" id="new-password" />
                                        <label for="new-password">Password</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input type="text" id="new-username" />
                                        <label for="new-username">Username</label>
                                    </div>
                                    <div class="col s12 right-align">
                                        <input type="submit" class="waves-effect waves-light btn"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="DataTables/datatables.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
</html>
