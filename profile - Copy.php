<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Profile | KLiK");
    
    if(!isset($_SESSION["SP_ID"]))
    {
        header("Location: login.php");
        exit();
    }
   
   $sp_id = $_SESSION["SP_ID"];
   $sp_company_name ="";
   $sp_username = "";
   $sp_fname = "";
   $sp_lname = "";
   $sp_contact ="";
   $sp_email = "";
   $image = "";
   
    $login_user = PDO_DB::query("select * from service_provider where sp_id = ?", 
        array($sp_id), "SELECT");
    if(count($login_user) > 0){
      foreach($login_user as $user){
          $sp_company_name =$user["SP_COMPANY_NAME"];
   $sp_username = $user["SP_USERNAME"];
   $sp_fname =$user["SP_FNAME"];
   $sp_lname = $user["SP_LNAME"];
   $sp_contact =$user["SP_CONTACT"];
   $sp_email =$user["SP_EMAIL"];
   $image = $user["image"];   

      } 
    } 
    
    
    include 'includes/HTML-head.php';   
?> 
</head>
       <link rel="stylesheet" type="text/css" href="css/comp-creation.css">
       <link rel="stylesheet" type="text/css" href="css/list-page.css">

<body>

    <?php include 'includes/navbar.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
              <?php include 'includes/profile-card.php'; ?>
              
          </div>
            
            
          <div class="col-sm-8 text-center" id="user-section">
              <img class="cover-img" src="img/event-cover1.png">
              <img class="profile-img" src="uploads/<?php echo $image; ?>">
           <img id="admin-badge" src="img/admin-badge.png">
                
              
              <h2><?php echo ucwords($sp_company_name); ?></h2>
              <h6><?php echo ucwords($sp_fname) . " " . ucwords($sp_lname); ?></h6>
              <h6><?php echo '<small class="text-muted">'.$sp_email.'</small>'; ?></h6>
              
             
                <i class="fa fa-male fa-2x" aria-hidden="true" style="color: #709fea;"></i>
                
              
              <br><small><?php echo $sp_contact; ?></small>
              
              
              
              <hr>
              <h3>Documents</h3>
              <br><br>
              
              <?php
                    $fetch_owner= PDO_DB::query("select * from service_provider_docs where  sp_id = ? ", array($sp_id), "SELECT");
                    echo '<div class="container">'
                                    .'<div class="row">';
                    if(count($fetch_owner)>0){
                    foreach($fetch_owner as $row){
                        
                             
                                    echo '<div class="col-sm-4" style="padding-bottom: 30px;">
                                        <div class="card user-blogs">
                                            <img class="card-img-top" src="uploads/'.$row['image'].'" alt="Card image cap">
                                            <div class="card-block p-2">
                                            </div>
                                            </a>
                                          </div>
                                          </div>';
                            }
                      }
                            echo '</div>'
                                    .'</div>';
                      
              ?>
              <div class="text-center">
                                        <br><br><a class="btn btn-light btn-lg btn-block" href="blogs.php">
                                            Add All Docs</a>
                                    </div>
              
              
              
          </div>
          <div class="col-sm-1">
            
          </div>
        </div>


      </div> <!-- /container -->

<?php include 'includes/footer.php'; ?>




<?php include 'includes/HTML-footer.php'; ?>