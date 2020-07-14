
<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Products | Event Puzzle");
    
    if(!isset($_SESSION["SP_ID"]))
    {
        header("Location: login.php");
        exit();
    }
    $sp_id = $_SESSION["SP_ID"];

    $prod_description ="";
    $prod_id = "";
    $prod_name = "";
    $prod_price = "";

    include 'includes/HTML-head.php';
    
?>  

        <link rel="stylesheet" type="text/css" href="css/list-page.css">
    </head>

    <body style="background: #f1f1f1">

        <?php include 'includes/navbar.php'; ?>
        
        <main role="main" class="container">
            
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
          <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h1 class="mb-0 text-white lh-100">Product</h1>
          <small>Information and Website Functions</small>
        </div>
      </div>

      <div class="row mb-2">
          
                <?php
                    $fetch_owner= PDO_DB::query("select * from product where  sp_id = ? ", array($sp_id), "SELECT");
                    
                    if(count($fetch_owner)>0){
                    foreach($fetch_owner as $row){
                
                            echo '<div class="col-md-6">
                                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                      <div class="card-body d-flex flex-column align-items-start">
                                        <div class="mb-1 text-muted">'.$row['PROD_STATUS'].'</div>
                                        <h3 class="mb-0">
                                          <a class="text-dark" href="blog-page.php?prod_id='.$row['PROD_ID'].'">'.$row['PROD_NAME'].'...</a>
                                        </h3>
                                        <div class="mb-1 text-muted">'.$row['PROD_PRICE'].'</div>
                                        <p class="card-text mb-auto">'.substr($row['PROD_DESCRIPTION'],0,70).'...</p>
                                        <a href="blog-page.php?prod_id='.$row['PROD_ID'].'">Edit/Delete This Product</a>
                                      </div>
                                      <img class="card-img-right flex-auto d-none d-lg-block bloglist-cover" 
                                            src="uploads/'.$row['image'].'" alt="Card image cap">
                                    </div>
                                  </div>';
                    }
                    }
                ?>        
          
          
      </div>
            
    </main>
        
        <?php include 'includes/footer.php'; ?>
        
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    </body>
</html>
