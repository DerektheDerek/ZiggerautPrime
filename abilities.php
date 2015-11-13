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
        <div class="above-nav"></div>
        <nav role="navigation">
            <div class="nav-wrapper navbar">
              <a href="#" class="brand-logo nav-logo">ZIGGERAUT PRIME</a>
              <ul id="nav" class="right hide-on-med-and-down">
                <li><a href="index.php" class="waves-effect waves-light nav-btn ">HOME</a></li>
                <li><a href="#" class="waves-effect waves-light nav-btn active">ABILITIES</a></li>
                <li><a href="#" class="waves-effect waves-light nav-btn">WEAPONS</a></li>
                <li><a href="#" class="waves-effect waves-light nav-btn">TRACKER</a></li>
                <li><a href="#" class="waves-effect waves-light nav-btn">LOGIN</a></li>
              </ul>
              <a href="#" data-activates="nav-mobile" class="button-collapse the-menu"><i class="material-icons">menu</i></a>
              <ul class="side-nav" id="nav-mobile">
                <li class="li-fill"><a href="index.php" class="waves-effect waves-light nav-btn ">HOME</a></li>
                <li class="li-fill"><a href="#" class="waves-effect waves-light nav-btn active">ABILITIES</a></li>
                <li class="li-fill"><a href="#" class="waves-effect waves-light nav-btn">WEAPONS</a></li>
                <li class="li-fill"><a href="#" class="waves-effect waves-light nav-btn">TRACKER</a></li>
                <li class="li-fill"><a href="#" class="waves-effect waves-light nav-btn">LOGIN</a></li>
              </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="center-align">ABILITIES</h3>
                    <?php
                        include('db_connect.php');
                        $q = "select * from abilities order by class";
                        echo '
                            <table id="tblAbilities" class="stripe compact" cellspacing="0">
                                <thead>
                                    <th style="width:20%">Name</th>
                                    <th>Effect</th>
                                    <th>Cost</th>
                                    <th>Class</th>
                                </thead>
                                <tbody>
                            ';
                        try{
                            
                            foreach($dbh->query($q) as $row){
                                echo '<tr>
                                      <td style="font-weight:bold">'.$row["name"].'</td>
                                      <td>'.$row["effect"].'</td>
                                      <td>'.$row["cost"].'</td>
                                      <td>'.$row["class"].'</td>
                                      </tr>
                                ';
                            }
                        }
                        catch(PDOException $e){
                            echo "Unable to pull abilities at this time.";
                        }
                        
                        echo '
                                </tbody>
                            </table>
                        ';
                        $dbh = null;
                    ?>
                </div>
            </div>
        </div>
        
        
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="DataTables/datatables.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
</html>
