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
        <div class="promo">
            <div class="promo-icons">
                <a href="https://twitter.com/anosina"><img src="img/twitter.png" class="promo-icon responsive-image"/></a>
                <a href="http://github.com/derekthederek/ZiggerautPrime"><img src="img/github.png" class="promo-icon responsive-image"/></a>
            </div>
        </div>
        <div class="banner">
                <div class="row">
                    <div class="home-center center-align">
                        <p class="title-logo">ZIGGERAUT PRIME</p>
                    </div>
                <div class="hell-hole center-align">
                    <div class="hhtext">THAT HELL HOLE</div>
                </div>
                <div class="modaltrigger-container center-align">
                    <div class="modalbtn circle waves-effect waves-light modal-trigger" data-target="signup">
                        <span id="chatus">?</span>
                    </div>
                </div>
            </div>                

        </div> 
          <!-- Modal Structure -->
         <div id="signup" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="modal-header center-align">
                    <div class="container">
                        <div class="row">
                            <div class="col offset-m3 m6 s12">
                                <h5>Looking For Alpha Testers</h5>
                                <p>Want to be a developer? Want to create a signature
                                Warband and help move this all the way through beta and
                                into the multiverse? Contact the web admin below to be invited
                                to alpha tests. </p>
            
                                <o>You'll get to play lots of fun games with the tabletop developers
                                and the webcomic team! Want to add rules or adjust others, maybe you
                                have one crazy good idea, maybe you just like the game and wanna play
                                with the home team?</p>
            
                                <p>Crash land on ZP before we destroy it</p>
                                <?php if(!isset($_SESSION['username'])) echo '<a href="login.php?signup" class="waves-light waves-effect btn">Register</a>'; ?>
                            </div>
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
    <?php include('footer.php'); ?>
</html>
