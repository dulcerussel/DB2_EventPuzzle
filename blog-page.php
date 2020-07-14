<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Product Page| Event Puzzle");
    
    if(!isset($_SESSION['SP_ID']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['prod_id']))
    {
        $prod_id = $_GET['prod_id'];
    }
    else
    {
        header("Location: index.php");
        exit();
    }
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
               <form class="contact2-form" action="includes/updel-blog.inc.php" method="post" 
                                  enctype="multipart/form-data">
                
             <?php 

             $values = PDO_DB::query("select * from product where prod_id = ?", array($prod_id), "SELECT");
             if(count($values) > 0){

              foreach($values as $r){
                $image = $r['image'];
             
              
             echo '<label class="btn btn-primary">
                        Update Product Photo <input type="file" id="imgInp" name="dp" hidden>
                    </label>
                    <img class="product-img" id="blah" name="image"  src="#"> ';  
                    echo '
               <label>Category</label>
                    <select  class="form-control" name="prt_id" >
                        <option>Please Select Your Product Type</option>
                        <option value="A">Package Only</option>
                        <option value="B">Stage Only</option>                       
                    </select><br><br>
                                    
                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="prod_name" id="prod_name" value="'.$r["PROD_NAME"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="prod_price" id="prod_price" value="'.$r["PROD_PRICE"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Days is required">
                        <input class="input2" type="number" name="prod_adjustment_days" id="prod_adjustment_days" value="'.$r["PROD_ADJUSTMENT_DAYS"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Status is required">
                        <input class="input2" type="text" name="prod_status" id="prod_status" value="'.$r["PROD_STATUS"].'">
                        <span class="focus-input2" ></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate = "Product Description is required">
                        <textarea class="input2" id="prod_description" name="prod_description" rows="20" value="'.$r["PROD_DESCRIPTION"].'"></textarea>
                        <span class="focus-input2" ></span>
                    </div>

                    ';}
              }
              ?>
                    
                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="Update-blog-submit">
                                Update Product
                                                        </button>
                                                        
                        </div>
                    </div>
                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="Delete-blog-submit">
                                Delete Product
                                                        </button>
                                                        
                        </div>
                    </div>
                                    <div class="text-center">
                                    
                                        <br><br><a class="btn btn-light btn-lg btn-block" href="blogs.php">
                                            View All Product</a>
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
                               
                                var dp = 'img/addphoto.png';

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