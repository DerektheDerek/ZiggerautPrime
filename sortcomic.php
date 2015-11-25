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
        <?php include('header.php'); 
        include('db_connect.php');
        if(isset($_SESSION['access'])) {
            if($_SESSION['access'] != '1')
                header('Location: comic.php'); 
        } else { header('Location: comic.php'); }
        if(isset($_GET['auto_sort'])){
            $directory = new \RecursiveDirectoryIterator("img/comic/panels");
            $iterator = new \RecursiveIteratorIterator($directory);
            $files = array();
            $animations = array();
            $delete = $dbh->prepare('delete from panels');
            $delete->execute();
            $stmt = $dbh->prepare("insert into panels (path, ch, panelOrder) values (:path, :ch, :panelOrder)");
            $stmt->bindParam(':path', $path);
            $stmt->bindParam(':ch', $ch);
            $stmt->bindParam(':panelOrder', $panelOrder);
            $i=0;
            echo "<div class='container center-align'>";
            echo "<div id='s'></div>";
            echo "<div class='row'><a href='sortcomic.php' class='btn waves-effect waves-light'>Back</a></div>";
            
            //get dem panels
            foreach ($iterator as $info) { $files[] = $info->getPathname(); }

            //sort the panels
            natsort($files);
            
            //store them in the database
            foreach($files as $file){
                $path=$file;
                $ch = explode("_",$file)[2];
                $panelOrder = $i+1;
                if((explode("min",$file)[1] == ".jpg") || explode(".",$file)[1] == "html"){
                    try{
                        $stmt->execute();
                        echo "<p>".$path." - Chapter $ch - <span style='color:green; font-weight:bold;'>Success!</span></p>";
                        $i++;
                    }
                    catch(PDOException $e){
                        echo "Something fucked up: <br>".$e->GetMessage();
                    }
                }
            }
            echo "</div>";
            echo "<br><h2 id='success'>Database synced with Panels directory</h2>";
        }
        else{
            $stmt = $dbh->prepare("select * from panels order by panelOrder");
            ?>
            <div class="container center-align">
                <a href="sortcomic.php?auto_sort=1" class="btn waves-effect waves-light">Auto Sort</a>
            </div>
            <?php
        }
    ?>
    </body>
    
 
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="DataTables/datatables.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script tpye="text/javascript">
        $("#success").appendTo("#s");
    </script>
    </body>
</html>