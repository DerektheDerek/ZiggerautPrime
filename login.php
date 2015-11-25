<?php 
    session_start();
    include('db_connect.php');
    if (isset($_SESSION['username'])) header('Location: index.php');
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $dbh->prepare("select username, password, access from users where username = :username and password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', md5($password));
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $success = true;
                $_SESSION['access'] = $row['access'];
            }
            if($success){ $_SESSION['username'] = $_POST['username']; header('Location: index.php');}
        }
    } else if (isset($_POST['new-username'])) {
        if($_POST['new-password']==$_POST['confirm-password']){
            $sel = $dbh->prepare("select * from users where username = :username or email = :email");
            $sel->bindParam(':username', $_POST['new-username']);
            $sel->bindParam(':email', $_POST['email']);
            if($sel->execute()){
                while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
                    if($row['username'] == $_POST['new-username']){
                        echo "user-exists";
                    }
                    if($row['email'] == $_POST['email']){
                        echo "email-exists";
                    }
                }
            }
            $stmt = $dbh->prepare("insert into users (username, password, email) values (:username, :password, :email)");
            $stmt->bindParam(':username', $_POST['new-username']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':password', md5($_POST['new-password']));
            $stmt->execute();
            $_SESSION['username'] = $_POST['new-username'];
            header('Location: index.php');
        } else {
            echo "<script>var check='no match';</script>";
        }
        
    } else if (isset($_GET['logout'])){
        if($_GET['logout'] == true){
            session_destroy();
            header('Location: index.php');
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Ziggeraut Prime</title>
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/materialize.css" media="screen"/>
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
                        <div id="problem">Incorrect username or password.</div>
                        <form action="login.php" id="login-form" method="post" autocomplete="off">
                            <div class="col s12 m10 l7 input-field">
                                <i class="material-icons prefix form-icon">account_circle</i>
                                <input type="text" id="username" name="username" class="zpform" required placeholder="Username"/>
                                
                            </div>
                            <div class="col s12 m10 l7 input-field">
                                <i class="material-icons prefix form-icon">vpn_key</i>
                                <input type="password" id="password" name="password" class="zpform" placeholder="Password"/>
                                
                            </div>
                            <div class="col s12 m10 l7 right-align">
                                <button type="submit" class="waves-effect waves-light btn" id="submit">Submit</button>
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
                            <form action="login.php" id="registration-form" method="post" autocomplete="off">
                                <div class="col offset-m3 m6 s12">
                                    <h5>ALPHA REGISTRATION</h5>
                                    <div class="col s12 input-field">
                                        <label for="email" class="hidden pull-left"></label>
                                        <input type="email" id="email" class="validate" name="email" required placeholder="Email"/>
                                        
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="username" class="hidden pull-left"></label>
                                        <input type="text" id="new-username" name="new-username" required placeholder="Desired Username"/>
                                        
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="password" class="hidden pull-left"></label>
                                        <input type="password" id="new-password" name="new-password" required placeholder="Password"/>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input type="password" id="confirm-password" name="confirm-password" required placeholder="Confirm Password"/>
                                    </div>
                                    <div class="col s12 right-align">
                                        <button type="submit" class="waves-effect waves-light btn" id="register">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript">

        if(fileName(window.location.href).split(".")[0] == ""){
            var desktop_view = $("#nav").children("li")[0];
            var mobile_view = $("#side-nav").children("li")[0];
            $(desktop_view).children("a").addClass("active");
            $(mobile_view).children("a").addClass("active");
        }
        else{
            $(".nav-btn:contains('"+fileName(window.location.href).split(".")[0].toUpperCase()+"')").each(function(){
                $(this).addClass("active"); 
            });
        }
        if(location.search!="" && location.search.split("?")[1] == "signup"){
            $('#signup').openModal();
        }
        $("#new-username").keydown(function(){
            CheckReg();
        });
        $("#email").keydown(function(){
            CheckReg(); 
        });
        $("#new-password").keydown(function(){
            CheckReg(); 
        });
        
        var password = document.getElementById("new-password")
          , confirm_password = document.getElementById("confirm-password")
          , new_username = document.getElementById("new-username");
        
        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
        }
        
        function validateUsername(){
            if(new_username.value.length > 18) {
                new_username.setCustomValidity("Username Is Too Long");
            } else {
                new_username.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
        new_username.onkeyup = validateUsername;
        

        
        function CheckReg(){
            if($("#new-username").val()=="" || $("#email").val()=="" || $("#new-password").val() ==""){

            }
            else $("#register").removeClass("disabled");
        }

        function fileName(href){
            return href.replace(/^.*[\\\/]/, '');
        }
        </script>
    </body>
</html>
