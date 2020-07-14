<?php
    error_reporting(E_ALL);
    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Profile | EventPuzzle");
    
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
   
    $login_user = PDO_DB::query("select * from service_provider where sp_id = ?", array($sp_id), "SELECT");
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

<link href="css/list-page.css" rel="stylesheet">
        <link href="css/loader.css" rel="stylesheet">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
              <?php include 'includes/profile-card.php'; ?>
              
          </div>
            
            
          <div class="col-sm-8 text-center" id="user-section">
              <img class="cover-img" src="img/event-cover1.png">
              <img class="profile-img" src="uploads/<?php echo $user['image']; ?>">

              
              <h2><?php echo ucwords($sp_company_name); ?></h2>
              <h6><?php echo ucwords($sp_fname) . " " . ucwords($sp_lname); ?></h6>
              <h6><?php echo '<small class="text-muted">'.$sp_email.'</small>'; ?></h6>
              
             
                <i class="fa fa-male fa-2x" aria-hidden="true" style="color: #709fea;"></i>
                
              
              <br><small><?php echo $sp_contact; ?></small>

              
              <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="forum-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Products</h1>
                                  </div>
                                </div>  

                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    <?php

                                        $login_user = PDO_DB::query("select * from product where sp_id = ? LIMIT 3 ", 
        array($sp_id), "SELECT");
                                        if(count($login_user) > 0){
                                            foreach($login_user as $row)
                                            {
                                                echo '<div class="col-md-6">
                                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                        <a href="blogs.php?prod_id='.$row['PROD_ID'].'">
                                                        <img class="card-img-left flex-auto d-none d-lg-block blogindex-cover" 
                                                                src="uploads/'.$row['image'].'" alt="Card image cap">
                                                                </a>
                                                          <div class="card-body d-flex flex-column align-items-start">
                                                            <h6 class="mb-0">
                                                              <a class="text-dark" href="posts.php?topic='.$row['PROD_ID'].'">'
                                                                .substr(ucwords($row['PROD_NAME']),0,15).'...</a>
                                                            </h6>
                                                            <small class="mb-1 text-muted">'.$row['PROD_PRICE'].'</small>
                                                            <small class="card-text mb-auto">Status: '.ucwords($row['PROD_STATUS']).'</small>
                                                            <a href="blogs.php?prod_id='.$row['PROD_ID'].'">Go To This Product</a>
                                                          </div>

                                                        </div>
                                                      </div>';
                                            }
                                        }
                                ?>
                                <a href="create-blog.php" class="btn btn-warning btn-lg btn-block">Create a Product</a>
                                <div class="text-center">
                                        <br><br><a class="btn btn-light btn-lg btn-block" href="blogs.php">
                                            View All Products</a>
                                        </div>

                            </div> 
                            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Branches</h1>
                                  </div>
                                </div>  

                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    <?php

                                        $login_user = PDO_DB::query("select * from service_provider_branch_address where sp_id = ? LIMIT 3 ", 
        array($sp_id), "SELECT");
                                        if(count($login_user) > 0){
                                            foreach($login_user as $row)
                                            {
                                                echo '<div class="col-md-6">
                                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                        <a href="topics.php?spba_id='.$row['SPBA_ID'].'">
                                                        <img class="card-img-left flex-auto d-none d-lg-block blogindex-cover" 
                                                                src="uploads/'.$row['IMAGE'].'" alt="Card image cap">
                                                                </a>
                                                          <div class="card-body d-flex flex-column align-items-start">
                                                            <h6 class="mb-0">
                                                              <a class="text-dark" href="posts.php?spba_id='.$row['SPBA_ID'].'">CITY:'
                                                                .substr(ucwords($row['SPBA_CITY']),0,15).'...</a>
                                                            </h6>
                                                            <small class="mb-1 text-muted">BRGY:'.$row['SPBA_BARANGAY'].'</small>
                                                            <small class="card-text mb-auto">SITIO: '.ucwords($row['SPBA_SITIO']).'</small>
                                                            <a href="topics.php?spba_id='.$row['SPBA_ID'].'">Go To This Branch</a>
                                                          </div>

                                                        </div>
                                                      </div>';
                                            }
                                        }
                                ?>
                                <a href="create-topic.php" class="btn btn-warning btn-lg btn-block">Create a Branch</a>
                                <div class="text-center">

                                        <br><br><a class="btn btn-light btn-lg btn-block" href="topics.php">
                                            View All Branches</a>
                                        </div>

                            </div>
                            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Summary Report</h1>
                                  </div>
                                </div>  
                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    <?php
                                    $count = 0;

                                    $login_user = PDO_DB::query("CALL getCountProduct(?)",array($_SESSION["SP_ID"]), "SELECT");
                                        if(count($login_user) > 0){
                                          $user = $login_user[0];
                                    echo '
                                        <a class="text-dark" >Number of Products:</a><a class="text-dark" >  '.$user["counter"].'</a><br><br>';
                                      
                                      } 
                                    $login_user = PDO_DB::query("CALL getCountBranch(?)",array($_SESSION["SP_ID"]), "SELECT");
                                        if(count($login_user) > 0){
                                          $user = $login_user[0];
                                    echo '
                                        <a class="text-dark" >Number of Branches:</a><a class="text-dark" >  '.$user["counter"].'</a>';
                                      
                                      }   
                                    ?>

                                </div>  



                            </div>   

   
          </div>
          <div class="col-sm-1">
                                
                        
                    </div>
          </div>
        </div>


      </div> <!-- /container -->

<?php include 'includes/footer.php'; ?>

<?php include 'includes/HTML-footer.php'; ?>