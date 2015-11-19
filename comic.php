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
        <div class="row">
            <div class="col s12">
                <div class="pull-right">
                    <a class="modal-trigger waves-effect waves-light btn pull-right" href="#edit-modal" id="open-add">+</a>
                </div>
            </div>
        </div>

        <div id="edit-modal" class="modal bottom-sheet">
            <div class="modal-content">
              <h4 id="form-title">Add New Panel</h4>
            </div>
            <div class="modal-footer">
              <button class="waves-effect waves-white btn close-btn">Close</button>
              <input type="submit" class="waves-effect waves-white btn"></input>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 center-align">
                    <h3 class="center-align">COMIC</h3>
                    <p id="chtxt"><span>Ch. </span><span id="chapter"></span><span>Pg. </span><span id="page"></span></p>
                    <?php
                        //connect to database
                        include ('db_connect.php');
                        $directory = 'img/comic'; //path to thumbnails
                        $allowed_types = array('jpg','jpeg','gif','png'); 
                        $aFiles = array();
                        $dir_handle = @opendir($directory) or die("There is an error with your image directory!"); 
                        while ($file = readdir($dir_handle)) //traverse through files
                        { 
                            if($file=='.' || $file == '..') continue; //skip links to parent directories
                            $file_parts = explode('.',$file); //split filenames and put each part in an array
                            $ext = strtolower(array_pop($file_parts)); //last element is the file extension
                            $title = implode('.',$file_parts); //what's left is the filename
                            if(in_array($ext,$allowed_types)) 
                            { 
                            $aFiles[] = $file; //filename array
                            }
                        } 
                        closedir($dir_handle); //close directory
                        natsort($aFiles); // natural sort by filename 01, 02, 10, 20
                        $i=0; 
                        foreach ($aFiles as $file) {
                        $file_parts = explode('.',$file); //split filenames and put each part in an array
                        $ext = strtolower(array_pop($file_parts)); //last element is the file extension
                        $title = implode('.',$file_parts); //what's left is the filename
                        $title = htmlspecialchars($title);	//make it html-safe 
                        echo ' 
                        //add fancybox class for viewer
                        <div class="thumbs fancybox" style="background:url('.$directory.'/'.$file.') no-repeat 50% 50%">
                        //group linked images into one slideshow
                        <a rel="group" href="slides/'.$file.'" title="'.$title.'">'.$title.'</a>
                        </div>';
                        $i++;	//increment the image counter
                        /*
                        //prepare our query to pull the panel data from the database (experimental scripted order - not dynamic)
                        $select = $dbh->prepare("SELECT SUBSTRING_INDEX( path,  'z', 1 ) AS first_part, SUBSTRING_INDEX( path,  '/', -1 ) AS second_part, path, panelOrder, ch
                                                 FROM panels
                                                 ORDER BY LENGTH( first_part ) , first_part, second_part");
                        //we'll be throwing shit into these arrays from the database
                        $panels = array();
                        $chapter = array();
                        $page = array();
                        //run the query and use $select to pass our shit through. if it works, then
                        if ($select->execute()) {
                            //loop through the rows of $select.
                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                //add the value of each row/column to their respective arrays
                                $panels[] = $row["path"];
                                $chapter[] = $row["ch"];
                                $page[] = $row["panelOrder"];
                            }
                        }
                        */
                    ?>
                    <div class="row hidden" id="comic-container">
                            <img id="loader" src="img/loader.gif" class="hidden" />
                            <img id="comic" alt="Invalid Comic Page" class="responsive-img z-depth-4" />
                        </div>
                        <div class="row">
                            <div class="col s3">
                                <img class="waves-effect waves-light pull-right hoverable cnav-btn circle" id="first" src="img/navbtns/navfirst.png"></img>
                            </div>
                            <div class="col s3">
                                <img class="waves-effect waves-light pull-left hoverable cnav-btn circle" id="prev" src="img/navbtns/navprev.png"></img>
                            </div>
                            <div class="col s3">
                                <img class="waves-effect waves-light pull-right hoverable cnav-btn circle" id="next" src="img/navbtns/navnext.png"></img>
                            </div>
                            <div class="col s3">
                                <img class="waves-effect waves-light pull-left hoverable cnav-btn circle" id="last" src="img/navbtns/navlast.png"></img>
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
        <script type="text/javascript">
            
            //javascript version of the above php arrays
            var panels, chapter, page;
            //counter variable
            var i = 0;

            //if there's no page number in the address bar, i = 0 (page 1), otherwise go set i = page#
            location.search != "" ? i = location.search.split("?")[1]-1 : i = 0;
            
            <?php 
                //populate our javascript arrays with the data we got from the php query
                echo 'panels='.json_encode($panels).';';
                echo 'chapter='.json_encode($chapter).';';
                echo 'page='.json_encode($page).';';
            ?>
            //make sure that the buttons are greyed out if necessary
            CheckButton(i, panels);
            //set the comic panel img source to the path associated with the page #
            $("#comic").prop("src", panels[i]);
            //initialize the chapter number
            $("#chapter").html(chapter[i]);
            //fade it in
            $("#chtxt").fadeIn("slow");
            //intialize the page number
            $("#page").html(i==0 ? 1 : i+1);
            //fade in the rest of the comic once it's loaded
            $("#comic-container").fadeIn("slow");
            
            //on navigation arrow click
            $(".cnav-btn").click(function(){
               //get a handle on which button was clicked (this button!)
               var cnav_btn = $(this);
               //if this button is not disabled
               if(!$(this).hasClass("disabled")){
                   //fade out the comic
                   $("#comic").fadeTo(75, 0, function(){
                       //ensure comic is hidden
                       $("#comic").css("visibility", "hidden");
                       //if our clicked button was a "previous" button
                       if($(cnav_btn).prop("id") == "prev"){
                           //go back a page
                           $("#comic").prop("src", panels[i=i-1]);
                           $("#chapter").html(chapter[i]);
                           $("#page").html(i+1);
                       //otherwise go forward a page
                       } 
                       else if($(cnav_btn).prop("id") == "next"){
                           $("#comic").prop("src", panels[i=i+1]);
                           $("#chapter").html(chapter[i]);
                           $("#page").html(i+1);
                       }
                       else if($(cnav_btn).prop("id") == "first"){
                           $("#comic").prop("src", panels[i=0]);
                           $("#chapter").html(chapter[i]);
                           $("#page").html(i+1);
                       }
                       else if($(cnav_btn).prop("id") == "last"){
                           $("#comic").prop("src", panels[i=panels.length-1]);
                           $("#chapter").html(chapter[i]);
                           $("#page").html(i+1);
                       }
                       //once the new panel image is loaded in the browser
                       $("#comic").load(function(){
                           //fade it back in
                           $("#comic").css('visibility','visible').fadeTo(200, 1);
                       });
                       //check to see if any buttons should be disabled
                       CheckButton(i, panels);
                   });
               }
            });
            
            function CheckButton(i, panels){
                if(i == 0){
                    $("#prev").prop("src", "img/navbtns/navbacoff.png");
                    $("#prev").addClass("disabled");
                }
                else{
                    $("#prev").prop("src", "img/navbtns/navprev.png");
                    $("#prev").removeClass("disabled");
                }
                if(i+1==panels.length){
                    $("#next").prop("src", "img/navbtns/navforoff.png");
                    $("#next").addClass("disabled");
                }
                else{
                    $("#next").prop("src", "img/navbtns/navnext.png");
                    $("#next").removeClass("disabled");
                }
            }
        </script>
    </body>
</html>