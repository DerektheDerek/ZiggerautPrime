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
        <?php 
        include('header.php');
        include('db_connect.php');
        $nomurder=false;
        $stmt = $dbh->prepare(
            "SELECT m.id AS murderID, m.name AS murderName, motto, keelows
            FROM murders m
            LEFT JOIN users u ON m.ownedBy = u.id
            WHERE u.username =  :username"
        );
        $stmt->bindParam(":username", $_SESSION['username']);
        $murderID = array();
        $murder = array();
        $motto = array();
        $keelows = array();
        if($stmt->execute()){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $murderID[] = $row['murderID'];
                $murder[] = $row["murderName"];
                $motto[] = $row["motto"];
                $keelow[] = $row["keelows"];
            }
        }
        if(!isset($_SESSION['username']))
            header('Location: login.php');
        ?>
        
       
            
            
        <!-- Abilities Table Modal Window -->
        <div id="abilities" class="modal">
            <div class="modal-content">
              <h4>ABILITIES</h4>
              
            </div>
            <div class="modal-footer">
              <a href="#!" class="btn red right" onclick="CloseAbilitiesModal()">Cancel</a>
            </div>
        </div>
        
        <div id="loading-container">
            <iframe id="loadinghud" frameBorder="0" scrolling="no" src="loading/index.html"></iframe>
        </div>
        <div class="container tracker-main z-depth-5 hidden" id="new-murder-setup">
            <div class="row">
                <div class="col s12">
                    <div class="col s12 tracker-top">
                        <div class="center-align">
                            <h3>NEW MURDER</h3>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="container">
                <div class="row">
                    <h5>MURDER NAME:</h5>
                    <input type="text" id="murder-name" name="murder-name" required />
                </div>
                <div class="row">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header center-align">
                                <img src="img/trackericons/recruitsicon.png" class="table-icon" /><span class="header">RECRUITS</span>
                                <span class="header-pv">
                                    <span class="header-pv-total" id="recruit-header-total">0</span> / 100
                                </span>
                            </div>
                            <div class="collapsible-body">
                                <a href="#!" class="tracker-btn btn" id="new-recruit"><i class="material-icons">add</i></a>
                                <div class="murder-main">
                                    <div class="row" id="recruits-container">
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header center-align">
                                <img src="img/trackericons/gearicon.png" class="table-icon" /><span class="header">EQUIPMENT</span>
                                <span class="header-pv">
                                    <span class="header-pv-total" id="gear-header-total">0</span> / 50
                                </span>
                            </div>
                            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                        </li>
                        <li>
                            <div class="collapsible-header center-align">
                                <img src="img/trackericons/ATicon.png" class="table-icon" /><span class="header">ADVANCEMENT TABLE</span>
                                <span class="header-pv">
                                    <span class="header-pv-total" id="at-header-total">0</span> / 50
                                </span>
                            </div>
                            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                        </li>
                    </ul>
                </div>
                <div id="cancel-btn">
                    <a href="#!" class="tracker-btn btn right red">Cancel</a>
                </div>
            </div>
        </div>
        <div class="container tracker-main z-depth-5" id="manage-murder-container">
            <div class="row">
                <div class="col s12">
                    <div class="col s12 tracker-top">
                        <div class="center-align">
                            <span class="tracker-label"></span>
                            <h3>MANAGE MURDERS</h3>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="container">
                <div class="row">
                        <div class="button-container">
                            <a href="#!" class="waves-light waves-effect btn new-murder-btn" id="new-murder-btn">New Murder</a> 
                        </div>
                        <?php
                            $i=0;
                            foreach($murderID as $ID){
                                echo'
                                    <div class="murder-row container waves-effect waves-light center-align" id="'.$ID.'">
                                        <div style="position:absolute;">
                                            <span class="numbered left">#'.($i + 1).'</span>
                                        </div>
                                        <div class="col s12">
                                            <span class="flext-text murder-title">'.$murder[$i].'</span>
                                        </div>
                                        <div class="col s12">
                                            <div class="keelow-container">
                                                <img src="img/trackericons/keelowsicon.png" class="value-icon"/><span class="dynamic-value vcenter-value">'.$keelow[$i].'</span>
                                                <i class="material-icons star-icon" style="color:#ffc800">stars</i><span class="dynamic-value vcenter-value">0</span>
                                            </div>
                                        </div>   
                                    </div>
                                ';
                                $i++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="DataTables/datatables.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript">
        var recruit_count = 0;
        var recruit_header_total = 0;
        var recruit_value_sum = 0;
        var card_sum = [];
            $(document).ready(function(){
                
                $('.modal-trigger').leanModal();
                
                $("#loading-container").delay(1).fadeOut('false', function(){
                   //$("#manage-murder-container").slideDown(1000); 
                   $("#new-murder-setup").slideDown(1000);
                });
                
                $("#new-murder-btn").click(function(){
                   $("#manage-murder-container").slideUp(1000, function(){
                       $("#new-murder-setup").slideDown(1000);
                   });
                });
                
                $("#cancel-btn").click(function(){
                    $("#new-murder-setup").slideUp(1000, function(){
                        $("#manage-murder-container").slideDown(1000);
                        $(':input').val('');
                    }) ;
                });
                
                $('.collapsible').collapsible({
                  accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
                });
                
                
                
                $("#new-recruit").click(function(){
                    recruit_count++;
                    var card_pt_total = 0;
                    var current_card = $('<div class="col s12 m6 l4" id="card_container_'+recruit_count+'">'+
                        '<div class="card-outer">'+
                            '<div class="left close-btn-bk red circle" onclick="CloseCard(this)" id="card_close_'+recruit_count+'">'+
                                '<i class="material-icons close-btn">close</i>'+
                            '</div>'+
                            '<div class="right recruit-pts">'+
                                '<span class="unit-total" id="unit_total_num_'+recruit_count+'"></span> PTS'+
                            '</div>'+
                            '<div class="recruit-name-container center-align col s12">'+
                                '<input type="text" placeholder="Recruit Name" class="recruit-name center-align recruit_name_num_'+recruit_count+'" maxlength="20" required/>'+
                            '</div>'+
                            
                            '<div class="input-field col s12">'+
                              '<img src="img/trackericons/lifeicon.png" class="recruit-value-icon prefix" title="Life"/>'+
                              '<input type="number" id="life_num_'+recruit_count+'" class="recruit-value" onchange="SumCardValues(this)" min="1" value="1">'+
                            '</div>'+
                            '<div class="input-field col s12">'+
                              '<img src="img/trackericons/mcicon.png" class="recruit-value-icon prefix" title="MC"/>'+
                              '<input type="number" id="mc_num_'+recruit_count+'" class="recruit-value" onchange="SumCardValues(this)" min="1" value="1">'+
                            '</div>'+
                            '<div class="input-field col s12">'+
                              '<img src="img/trackericons/rcicon.png" class="recruit-value-icon prefix" title="RC"/>'+
                              '<input type="number" id="rc_num_'+recruit_count+'" class="recruit-value" onchange="SumCardValues(this)" min="0" value="0">'+
                            '</div>'+
                            '<div class="input-field col s12">'+
                              '<img src="img/trackericons/spdicon.png" class="recruit-value-icon prefix" title="SPD"/>'+
                              '<input type="number" id="spd_num_'+recruit_count+'" class="recruit-value" onchange="SumCardValues(this)" min="3" value="3">'+
                            '</div>'+
                            '<div class="col s12 center-align">'+
                                '<a href="#abilities" class="btn abilities-btn modal-trigger" id="abilities_btn_num_'+recruit_count+'">Abilities</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>').hide().appendTo($("#recruits-container")).slideDown(500, function(){
                        $("#unit_total_num_"+recruit_count).html("5");
                        $("#recruit-header-total").html(Number($("#recruit-header-total").html())+5);
                    });
                    
                }); //end new-recruit click
                
            }); //end document ready
            
            function LimitRecruitName(value){
               var maxLength = 20;
               if(value.length > maxLength) return false;
               return true;
            }
            
            function CloseCard(card){
                var id = $(card).attr("id").split("_")[2];
                $("#card_container_"+id).slideUp(250, function(){
                    $(this).remove();
                    recruit_count--;
                    $("#recruit-header-total").html(Number($("#recruit-header-total").html())-card_sum[id]);
                });
            }
            
            function SumRecruitValues(){
                for(var i = 0; i < $(".recruit-value").length; i++){
                   recruit_value_sum += Number($(".recruit-value")[i].value);
                }
                //console.log(recruit_value_sum);
                $("#recruit-header-total").html(recruit_header_total=recruit_value_sum+(recruit_count*5));
                recruit_value_sum = 0;
            }
            
            function SumCardValues(card){
                var recruit_card_sum = 0;
                var id = $(card).attr("id").split("_")[2];
                for(var i = 0; i < $("input[id*='"+id+"']").length; i++){
                   recruit_card_sum += Number($("input[id*='"+id+"']")[i].value);
                }
                //console.log(recruit_card_sum);
                $("#unit_total_num_"+id).html(recruit_card_sum);
                SumAllCards();
                card_sum[id] = recruit_card_sum;
                return recruit_card_sum;

                //$("#recruit-header-total").html(recruit_header_total=recruit_value_sum+(recruit_count*5));
            }
            
            function SumAllCards(){
                var sumCards = 0;
                for(var i = 0; i < $("span[id^='unit_total_num_']").length; i++){
                     sumCards += Number($("span[id^='unit_total_num_']")[i].innerHTML);
                }
                $("#recruit-header-total").html(sumCards);
            }
            
            function CloseAbilitiesModal(){
                $("#abilities").closeModal();
            }
            
            function OpenAbilitiesModal(){
                $("#abilities").openModal();
            }
            
        </script>
    </body>
</html>
