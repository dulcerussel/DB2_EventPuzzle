<?php

    session_start();
    require 'includes/dbh.inc.php';
    define('TITLE',"Branch Address | Event Puzzle");
    
    if(!isset($_SESSION["SP_ID"]))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';

    $sp_id = $_SESSION["SP_ID"];
?>  


	<link rel="stylesheet" type="text/css" href="css/list-page.css">
    </head>
    <body style="background: #f1f1f1">

      <?php
            
            include 'includes/navbar.php';
        ?>
   

        <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
          <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h1 class="mb-0 text-white lh-100">Branch Address</h1>
          <small>and its informations and sales</small>
        </div>
      </div>  
            
            
      <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h5 class="border-bottom border-gray pb-2 mb-0">
                <?php 
                        echo "All Your Branch Address";
                ?>
          </h5>
        
        <?php

            
            $fetch_owner= PDO_DB::query("select * from service_provider_branch_address where  sp_id = ? ", array($sp_id), "SELECT");

            if(count($fetch_owner)>0){
                    foreach($fetch_owner as $row){
                
                    
                    echo '<div class="col-md-6">
                                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                      <div class="card-body d-flex flex-column align-items-start">
                                      <h3 class="mb-0">
                                          <a class="text-dark" href="posts.php?prod_id='.$row['SPBA_ID'].'">CITY:'.$row['SPBA_CITY'].'...</a>
                                        </h3>
                                        <div class="mb-1 text-muted">STREET:'.$row['SPBA_STREET'].'</div>
                                        <div class="mb-1 text-muted">PUROK:'.$row['SPBA_PUROK'].'</div>
                                        <div class="mb-1 text-muted">SITIO:'.$row['SPBA_SITIO'].'</div>
                                        <p class="card-text mb-auto">BRGY:'.substr($row['SPBA_BARANGAY'],0,70).'...</p>
                                        <a href="posts.php?spba_id='.$row['SPBA_ID'].'">Edit/Delete This BRANCH</a>
                                      </div>
                                      <img class="card-img-right flex-auto d-none d-lg-block bloglist-cover" 
                                            src="uploads/'.$row['IMAGE'].'" alt="Card image cap">
                                    </div>
                                  </div>';
                    
                    echo '</span>
                            </div>';
                }
           }
        ?>
        
        <small class="d-block text-right mt-3">
            <a href="create-topic.php" class="btn btn-primary">Create A Branch Address</a>
        </small>
        
      </div>
    </main>
        
        <?php include 'includes/footer.php'; ?>
           
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>