<?php
session_start(); 
if(isset($_SESSION['username'])){ ?>
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
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="DataTables/datatables.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript"></script>
    </body>
</html>

<?php } else header('Location: login.php'); ?>