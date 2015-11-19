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
                <div class="col s12 center-align">
                    <h3 class="center-align">EQUIPMENT</h3>
                    <p>Units are assumed to have only a one hand weapon that does one
                    damage unless given gear. Before gear, units make one attack in
                    combat and have no ranged attack. A unit may carry up to 3 hands (3h)
                    worth of weapons on them and another 3h worth of none weapon items (drugs,
                    grenades, etc.), but may only have 2 hands (2h) of weapons equipped at a time. 
                    A unit may equip a weapon by passing either their move or action.</p>
                    <?php
                        include('db_connect.php');
                        $q = "select * from equipment order by type";
                        echo '
                            <table id="tbl" class="stripe compact" cellspacing="0">
                                <thead>
                                    <th style="width:20%">Item</th>
                                    <th>Effect</th>
                                    <th>Cost</th>
                                    <th>Type</th>
                                </thead>
                                <tbody>
                            ';
                        try{
                            foreach($dbh->query($q) as $row){
                                echo '<tr>
                                      <td style="font-weight:bold">'.$row["item"].'</td>
                                      <td>'.$row["effect"].'</td>
                                      <td>'.$row["cost"].'</td>
                                      <td>'.$row["type"].'</td>
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
