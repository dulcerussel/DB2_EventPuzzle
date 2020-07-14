<?php

    session_start();
    include_once 'includes/dbh.inc.php';
    
    define('TITLE',"Create Branch Address | Event Puzzle");
    
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
    
    
    <div class="bg-contact2" style="background-image: url('img/banner.png');">
		<div class="container-contact2">
			<div class="wrap-contact2">
				<form class="contact2-form" method="post"  action="includes/create-topic.inc.php">

                    <label class="btn btn-primary position-absolute mt-2 ml-2">
                                            Add Branch Image <input type="file" id="imgInp" name='dp' hidden>
                                        </label>
                                        <img class="cover-img " id="blah"  src="#"> 
                                        
                                        <br><br><br>

					<span class="contact2-form-title">
						Create A Branch
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
                                            else if (isset($_GET['operation']) == 'success')
                                            {
                                                echo '<h5 class="text-success">*Forum successfully created</h5>';
                                            }
                                        ?>
                                        </span>
                                
                                    
                                    

					<div class="wrap-input2 validate-input" data-validate="Sitio is required">
						<input class="input2" type="text" name="spba_sitio" id="spba_sitio">
						<span class="focus-input2" data-placeholder="Sitio"></span>
					</div>

                    <div class="wrap-input2 validate-input" data-validate="Purok is required">
                        <input class="input2" type="text" name="spba_purok" id="spba_purok">
                        <span class="focus-input2" data-placeholder="Purok"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Barangay is required">
                        <input class="input2" type="text" name="spba_brgy" id="spba_brgy">
                        <span class="focus-input2" data-placeholder="Barangay"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Street is required">
                        <input class="input2" type="text" name="spba_street" id="spba_street">
                        <span class="focus-input2" data-placeholder="Street"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="City is required">
                        <input class="input2" type="text" name="spba_city" id="spba_city">
                        <span class="focus-input2" data-placeholder="City"></span>
                    </div>
                                    
                     

					<div class="container-contact2-form-btn">
						<div class="wrap-contact2-form-btn">
							<div class="contact2-form-bgbtn"></div>
                                                        <button class="contact2-form-btn" type="submit" name="create-topic">
								Create Branch Address
							</button>
						</div>
					</div>
                                    
                                    
                                    
                                
                                        
                                    <div class="text-center">
                                        <br><br><a class="btn btn-light btn-lg btn-block" href="topics.php">
                                            View All Branches</a>
                                    </div>
				</form>
			</div>
		</div>
	</div>
    
    
        
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        <script src="js/creation-main.js"></script>
        <script>
                                var dp = 'img/branch.png';
                                
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
