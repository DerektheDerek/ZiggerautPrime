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
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 center-align">
                    <h3 class="center-align">ABILITIES</h3>
                    <p>Units may be given any number of abilities. These represent training or talents
                       that the unit has, beyond those common on the battlefield.</p>
                    <?php
                        include('db_connect.php');
                        $q = "select * from abilities order by class";
                        echo '
                            <table id="tbl" class="stripe compact" cellspacing="0">
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
