<?php

    session_start();
    define('TITLE',"Create Blog | KLiK");
    
    if(!isset($_SESSION["SP_ID"]))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>  
        <link rel="stylesheet" type="text/css" href="css/comp-creation.css">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>
    
    
    <div class="bg-contact2" style="background-image: url('img/black-bg.jpg');">
        <div class="container-contact2">
                    
                    
                    
            <div class="wrap-contact2">
                            <form class="contact2-form" action="includes/create-blog.inc.php" method='post' 
                                  enctype="multipart/form-data">
                    <span class="contact2-form-title">
                        Create a Product
                    </span>

                                        <span class="text-center">
                                        <?php
                                            if(isset($_GET['error']))
                                            {
                                                if($_GET['error'] == 'emptyfields')
                                                {
                                                    echo '<h5 class="text-danger">*Fill In All The Fields</h5>';
                                                }
                                                else if ($_GET['error'] == 'sqlerror')
                                                {
                                                    echo '<h5 class="text-danger">*Website Error: Contact admin to have the issue fixed</h5>';
                                                }
                                            }
                                            else if (isset($_GET['catcreation']) == 'success')
                                            {
                                                echo '<h5 class="text-success">*Category successfully created</h5>';
                                            }
                                        ?>
                                        </span>

                    <label>Category</label>
                    <select  class="form-control" name="prt_id" >
                        <option>Please Select Your Product Type</option>
                        <!-- <?php 
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option value='.$row['prt_id'].'>' . $row['prt_description'] . '</option>';
        
                            }
                        ?> -->
                        <option value='A'>Package Only</option>
                        <option value='B'>Stage Only</option>
                    </select><br><br>
                                    
                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="prod_name" id="prod_name">
                        <span class="focus-input2" data-placeholder="Product Name"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="prod_price" id="prod_price">
                        <span class="focus-input2" data-placeholder="Product Price"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Days is required">
                        <input class="input2" type="number" name="prod_adjustment_days" id="prod_adjustment_days">
                        <span class="focus-input2" data-placeholder="Product Adjustment Days"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Status is required">
                        <input class="input2" type="text" name="prod_status" id="prod_status">
                        <span class="focus-input2" data-placeholder="Product Status: Available or N/A"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate = "Product Description is required">
                        <textarea class="input2" id="prod_description" name="prod_description" rows="20"></textarea>
                        <span class="focus-input2" data-placeholder="Product Description"></span>
                    </div>


                    <label class="btn btn-primary">
                        Add Product Photo <input type="file" id="imgInp" name='dp' hidden>
                    </label>
                    <img class="product-img" id="blah" name="image"  src="#"> 


                    <br><br><br>                
                    



                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="create-blog-submit">
                                Create Product
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
    
    
        
    
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <script src="js/creation-main.js"></script>
        
        
                            <script>
                                var dp = 'img/addphoto.png';
                                
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
        
    </body>
</html>
