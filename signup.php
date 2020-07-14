<?php
  

    error_reporting(E_ALL);
    include("includes/dbh.inc.php");

    session_start();
    define('TITLE',"Signup | Event Puzzle");
    
    if(isset($_SESSION['sp_id']))
    {
        header("Location: index.php");
        exit();
    }
    include 'includes/HTML-head.php';
?>  
    </head>
    
    <body>

        
        <div id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-1">
                        
                        <div class="signup-left position-fixed text-center">
                            
                            <img src="img/201.png">
                            <br><br><br>
                            <?php
                                $category = PDO_DB::query("select * from service_provider_type", array(), "SELECT");    
                              
                                  if (count($category) < 0  )
                                  {
                                   echo "<h5 class='text-center text-muted'>You cannot create a category before the admin creates "
                                                . "some categories</h5>";
                                  }


                                if(isset($_GET['error']))
                                {
                                    if($_GET['error'] == 'emptyfields')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Fill In All The Fields
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidmailuid')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid email and user name
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidmail')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid email
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invaliduid')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid user name
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'passwordcheck')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Passwords donot match
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'usertaken')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> This User name is already taken
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidimagetype')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Invalid image type 
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'imguploaderror')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Image upload error, please try again
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'imgsizeexceeded')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Image too large
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'sqlerror')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Website Error: </strong> Contact admin to have the issue fixed
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'sqlerror2')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Website Error: </strong> Contact admin to have the issue fixed
                                              </div>';
                                    }
                                }
                                else if (isset($_GET['signup']) == 'success')
                                {
                                    echo '<div class="alert alert-success" role="alert">
                                            <strong>Signup Successful</strong> Please Login from the login menu
                                          </div>';
                                }


                            ?>
                            <form id="signup-form" action="includes/signup.inc.php" method='post' 
                                  enctype="multipart/form-data">
                        
                                <input type="submit" class="btn btn-light btn-lg" name="signup-submit" value="Signup">
                                
                                <br><br>
                                
                                    <a  href="login.php">
                                        <i class="fa fa-sign-in fa-2x social-icon" aria-hidden="true"></i>
                                    </a> 
                            
                        </div>
                        
                        
                    </div>
                    
                    <div class="col-sm-6 offset-sm-6 text-center">
                        
                        <h1 class="mt-5 text-muted">Signup and Lets Go!</h1>
                        <br><br><br>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="sp_username" name="sp_username" placeholder="Username" maxlength="25">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="sp_email" name="sp_email" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" id="sp_password" name="sp_password" placeholder="Password">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="pwd-repeat">Confirmation</label>
                            <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" 
                                   placeholder="Repeat Password">
                          </div>
                        </div>
                        <div class="form-row border-top my-3">
                            <div class="form-group col-md-12">
                                <h2>Company Information</h2>
                            </div>
                        </div>
                        <div class="form-row ">
                          <div class="form-group col-md-6">
                            <label for="f-name">First Name</label>
                            <input type="text" class="form-control" id="sp_fname" name="sp_fname" placeholder="First name" maxlength="35">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="l-name">Last Name</label>
                            <input type="text" class="form-control" id="sp_lname" name="sp_lname" placeholder="Last name" maxlength="35">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="l-name">Contact Number</label>
                            <input type="text" class="form-control" id="sp_contact" name="sp_contact" placeholder="Contact number" maxlength="11">
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 align-self-center">
                            <label>Service Provider Type</label>
                                <select  class="form-control" name="spt_type" >
                                <option>Please Select Your Service Provider Type</option>
                                <!-- <?php 
                                    $valuess = PDO_DB::query("CALL getType", array(), "SELECT"); 

                                    foreach($valuess as $row)
                                    {
                                        echo '<option value='.$row['spt_type'].'>' . $row['spt_description'] . '</option>';
                                    }
                                ?> -->
                                <option value='1'>Flower Arrangement & Shop</option>
                                <option value='2'>Hotel</option>
                                <option value='3'>Coding Workshop</option>
                                <option value='4'>Staging & Equipment</option>
                                <option value='5'>Church</option>
                                <option value='6'>Photography & Videography</option>
                                <option value='7'>Food Catering</option>
                                <option value='8'>Clowns and Magical Acts</option>
                                <option value='9'>Emcees</option>
                                <option value='10'>Church and its Services</option>
                                <option value='11'>Speakers</option>
                                <option value='12'>Disc Jockeys</option>
                                <option value='13'>Artist and Model Management</option>

                                
                                </select><br><br>
                            </div>
                            <div class="form-group col-md-6 align-self-center">
                                <img id="blah" class="rounded" src="#" alt="your image" class="img-responsive rounded"
                                     style="height: 200px; width: 190px; object-fit: cover;">
                                <br><br><label class="btn btn-primary ">
                                    Set Avatar <input type="file" id="imgInp" name='dp' hidden>
                              </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="headline">Company Name</label>
                            <input type="text" class="form-control" id="sp_company_name" name="sp_company_name" 
                                   placeholder="Your Company Display Name" 
                                   maxlength="120">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bio">Company Description</label>
                            <textarea class="form-control" id="sp_description" name="sp_description" rows="6" maxlength="1000"
                            placeholder="Tell people about your company"></textarea>
                          </div>
                    </form>
                </div>
                    
                </div>
                
            </div>
        </div>
        
        
        
                            
                            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        
                            <script>
                                $('#blah').attr('src', 'uploads/default.png');
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