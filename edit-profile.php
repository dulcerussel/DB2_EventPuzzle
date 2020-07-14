<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Edit Profile | KLiK");
    
    if(!isset($_SESSION["SP_ID"]))
    {
        header("Location: login.php");
        exit();
    }
    
    // $spt_type = $_SESSION['SPT_TYPE'];
    // $sp_email = $_SESSION['SP_EMAIL'];
    // $sp_password = $_SESSION['SP_PASSWORD'];
    // $sp_contact = $_SESSION['SP_CONTACT'];
    // $sp_company_name = $_SESSION['SP_COMPANY_NAME'];
    // $sp_description = $_SESSION['sp_description'];
    // $sp_fname = $_SESSION['SP_FNAME'];
    // $sp_lname = $_SESSION['SP_LNAME'];

    include 'includes/HTML-head.php';  
?> 
</head>
<body>

    <?php include 'includes/navbar.php'; ?>
      <div class="container">
        <div class="row">
            <div class="col-sm-3">
            
                <?php include 'includes/profile-card.php'; ?>
                
            </div>
        <div class="col-sm-8 text-center" id="user-section">
              
              <img class="cover-img" id='blah-cover' src="img/event-cover1.png">
              
              <form action="includes/profileUpdate.inc.php" method='post' enctype="multipart/form-data"
                    style="padding: 0 30px 0 30px;">
                    
              
                    <label class="btn btn-primary">
                        Change Avatar <input type="file" id="imgInp" name='dp' hidden>
                    </label>
                    <img class="profile-img" id="blah"  src="#"> 


        
                          
                    

                    <h2><?php echo strtoupper($_SESSION['SP_USERNAME']); ?></h2>
                    <br>
                  
                    <div class="form-row">
                      <div class="col">
                        <input type="text" class="form-control" name="sp_fname" placeholder="First Name"
                               value="<?php echo $_SESSION['SP_FNAME'] ?>" >
                        <small id="emailHelp" class="form-text text-muted">First Name</small>
                      </div>
                      <div class="col">
                        <input type="text" class="form-control" name="sp_lname" placeholder="Last Name" 
                               value="<?php echo $_SESSION['SP_LNAME'] ?>" >
                        <small id="emailHelp" class="form-text text-muted">Last Name</small>
                      </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="sp_email" id="sp_email" placeholder="email" 
                               value="<?php echo $_SESSION['SP_EMAIL'] ?>" >
                             
                               <input type="password" class="form-control" id="contact" name="sp_contact" 
                               placeholder="<?php echo $_SESSION['SP_CONTACT']; ?>">

                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                  
                    
                  
                  <hr>
                  
                    <div class="form-group">
                        <label for="headline">Profile Headline</label>
                        <input class="form-control" type="text" id="headline" name="headline" 
                               placeholder="Your Profile Headline" value='<?php echo $_SESSION['SP_COMPANY_NAME']; ?>'><br>
                       
                    </div>
                  
                  <hr>
                  
                  <div class="form-group">
                        <label for="old-pwd">Change Password</label>
                        <input type="password" class="form-control" id="old-pwd" name="old-pwd" 
                               placeholder="<?php echo $_SESSION['SP_PASSWORD']; ?>">
                    </div>
                  
                    <div class="form-row">
                      <div class="col">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" 
                               placeholder="New Password">
                      </div>
                      <div class="col">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="pwd-repeat"
                               placeholder="Repeat New Password">
                      </div>
                    </div>
                  
                  <br><input type="submit" class="btn btn-primary" name="update-profile" value="Update Profile">
                  
              </form>
              
              
          </div>
          <div class="col-sm-1">
            
          </div>
        </div>


      </div> <!-- /container -->


<?php include 'includes/footer.php'; ?>

                            

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        
                            <script>
                                var dp = '<?php echo $_SESSION["image"]; ?>';
                                
                                $('#blah').attr('src', 'uploads/'+ dp);
                                
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