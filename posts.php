<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Product Page| Event Puzzle");
    
    if(!isset($_SESSION['SP_ID']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['spba_id']))
    {
        $spba_id = $_GET['spba_id'];
    }
    else
    {
        header("Location: index.php");
        exit();
    }
    $spba_id = "";
    $sp_id = $_SESSION["SP_ID"];
    $image = "";
    include 'includes/HTML-head.php'; 
?> 
    </head>
    <link rel="stylesheet" type="text/css" href="css/comp-creation.css">
    <body>

    <?php include 'includes/navbar.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
              <?php include 'includes/profile-card.php'; ?>
              
          </div>
            
            
          <div class="col-sm-9" id="user-section">
              
                <div class="bg-contact2" style="background-image: url('img/black-bg.jpg');">
        <div class="container-contact2">
                    
                    
                    
            <div class="wrap-contact2">
               <form class="contact2-form" action="includes/updel-post.inc.php" method="post" 
                                  enctype="multipart/form-data">
                
             <?php 

             $values = PDO_DB::query("select * from service_provider_branch_address where sp_id = ?", array($sp_id), "SELECT");
             if(count($values) > 0){

              foreach($values as $r){
                
               echo '
                <input class="input2" type="hidden" name="spba_id" id="spba_id"  value="'.$r["SPBA_ID"].'">';
              
             echo '<label class="btn btn-primary position-absolute mt-2 ml-2">
                                            Update Branch Image <input type="file" id="imgInp" name="dp" hidden>
                                        </label>
                                        <img class="cover-img " id="blah"  src="#">  ';  
                    echo '
               <div class="wrap-input2 validate-input" data-validate="Sitio is required">
            <input class="input2" type="text" name="spba_sitio" id="spba_sitio" value="'.$r["SPBA_SITIO"].'">
            <span class="focus-input2" ></span>
          </div>

                    <div class="wrap-input2 validate-input" data-validate="Purok is required">
                        <input class="input2" type="text" name="spba_purok" id="spba_purok" value="'.$r["SPBA_PUROK"].'">
                        <span class="focus-input2"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Barangay is required">
                        <input class="input2" type="text" name="spba_brgy" id="spba_brgy" value="'.$r["SPBA_BARANGAY"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Street is required">
                        <input class="input2" type="text" name="spba_street" id="spba_street" value="'.$r["SPBA_STREET"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="City is required">
                        <input class="input2" type="text" name="spba_city" id="spba_city" value="'.$r["SPBA_CITY"].'">
                        <span class="focus-input2" ></span>
                    </div>
                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="Update-post-submit">
                                Update Branch
                                                        </button>
                                                        
                        </div>
                    </div>
                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="Delete-post-submit">
                                Delete Branch
                                                        </button>
                                                        
                        </div>
                    </div>

                    ';}
              }
              ?>
                    
                    
                                    <div class="text-center">
                                    
                                        <br><br><a class="btn btn-light btn-lg btn-block" href="topics.php">
                                            View All Branch Address</a>
                                    </div>
                </form>
                
          </div>
          </div>
          </div>    
          </div>
            
        </div>


      </div> <!-- /container -->
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <script src="js/creation-main.js"></script>
        
        
                            <script>
                               
                                var dp = 'img/branch.png';

                                // var dp = 'img/addphoto.png';
                                
                                $('#blah').attr('src', dp);
                                
                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                      var reader = new FileReader();

                                      reader.onload = function(e) {
                                        $('#blah').attr('src', e.target.result);
                                        
                                      }

                                      reader.readAsDataURL(input.files[0]);
                                    }
                                  }

                                  $("#imgInp").change(function() {
                                    readURL(this);
                                  });
                                  
                                  
                            </script>
    

<?php include 'includes/footer.php'; ?>



<?php include 'includes/HTML-footer.php'; ?>