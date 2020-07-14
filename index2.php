
<?php
    
    error_reporting(E_ALL);
    include("includes/dbh.inc.php");
    session_start();

    define('TITLE',"Dashboard| KLiK");

    $companyName = "Franklin's Fine Dining";
    
    function strip_bad_chars( $input ){
        $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
        return $output;
    }
    
        if(!isset($_SESSION["SP_ID"]))
        {
            header("Location: login.php?error=login1");
            exit();
        }

    $spt_type = $_SESSION["SPT_TYPE"];
    $sp_company_name = $_SESSION["SP_COMPANY_NAME"];
    $sp_username = $_SESSION["SP_USERNAME"];
    $sp_password = $_SESSION["SP_PASSWORD"];
    $sp_fname = $_SESSION["SP_FNAME"];
    $sp_lname = $_SESSION["SP_LNAME"];
    $sp_contact = $_SESSION["SP_CONTACT"];

    
    include 'includes/HTML-head.php';
?> 
        <link href="css/list-page.css" rel="stylesheet">
        <link href="css/loader.css" rel="stylesheet">
    </head>
    
    <body>
        
        <!-- <div id="loader-wrapper">
        <img src='img/501.png' id='loader-logo'>
            <div class="loader">
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__ball"></div>
            </div>
        </div> -->
        
        <div id="content">
            
            <?php include 'includes/navbar.php'; ?> 
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3" >

                        <?php include 'includes/profile-card.php'; ?>

                    </div>

                    <div class="col-sm-7" >

                        <div class="text-center p-3">
                            <img src="img/201.png">
                            <h2 class='text-muted'>DASHBOARD</h2>
                            <br>
                        </div>


                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="forum-tab" data-toggle="tab" href="#forum" role="tab" 
                                 aria-controls="forum" aria-selected="true">Orders</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="blog-tab" data-toggle="tab" href="#blog" role="tab" 
                                 aria-controls="blog" aria-selected="false">Products</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="poll-tab" data-toggle="tab" href="#poll" role="tab" 
                                 aria-controls="poll" aria-selected="false">Branches</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="event-tab" data-toggle="tab" href="#event" role="tab" 
                                 aria-controls="event" aria-selected="false">Event Calendar</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="event-tab" data-toggle="tab" href="#reports" role="tab" 
                                 aria-controls="event" aria-selected="false">Summary Report</a>
                            </li>
                        </ul>   
                        <br>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="forum-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Orders</h1>
                                  </div>
                                </div>  

                                <div class="row mb-2">

                                    

                                </div>

                            </div>

                            

                            <div class="tab-pane fade" id="blog" role="blog" aria-labelledby="blog-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Products</h1>
                                  </div>
                                </div>  

                                <div class="row mb-2">
                                    <?php

                                        $login_user = PDO_DB::query("select * from product where sp_id = ? LIMIT 6 ", 
        array($sp_id), "SELECT");
                                        if(count($login_user) > 0){
                                            foreach($login_user as $row)
                                            {
                                                echo '<div class="col-md-6">
                                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                        <a href="posts.php?topic='.$row['PROD_ID'].'">
                                                        <img class="card-img-left flex-auto d-none d-lg-block blogindex-cover" 
                                                                src="img/'.$row['image'].'" alt="Card image cap">
                                                                </a>
                                                          <div class="card-body d-flex flex-column align-items-start">
                                                            <h6 class="mb-0">
                                                              <a class="text-dark" href="posts.php?topic='.$row['PROD_ID'].'">'
                                                                .substr(ucwords($row['PROD_NAME']),0,15).'...</a>
                                                            </h6>
                                                            <small class="mb-1 text-muted">'.$row['PROD_PRICE'].'</small>
                                                            <small class="card-text mb-auto">Status: '.ucwords($row['PROD_STATUS']).'</small>
                                                            <a href="posts.php?topic='.$row['PROD_ID'].'">Go To This Product</a>
                                                          </div>

                                                        </div>
                                                      </div>';
                                            }
                                        }
                                    ?>
                                    
                                </div>

                            </div>

                            <div class="tab-pane fade" id="poll" role="poll" aria-labelledby="poll-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Branches</h1>
                                  </div>
                                </div>  

                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    <?php

                                    $sql = "select p.id, p.subject, p.created, p.poll_desc, p.locked, (
                                                select count(*) 
                                                from poll_votes v
                                                where v.poll_id = p.id
                                                ) as votes
                                            from polls p 
                                            order by votes desc
                                            LIMIT 5";

                                    $stmt = mysqli_stmt_init($conn);    

                                    if (!mysqli_stmt_prepare($stmt, $sql))
                                    {
                                        die('SQL error');
                                    }
                                    else
                                    {
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        while ($row = mysqli_fetch_assoc($result))
                                        {

                                            echo '<a href="poll.php?poll='.$row['id'].'">
                                                <div class="media text-muted pt-3">
                                                    <img src="img/poll-cover.png" alt="" class="mr-2 rounded div-img poll-img">
                                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray ">
                                                      <strong class="d-block text-gray-dark">'.ucwords($row['subject']).'</strong></a>
                                                          '.date("F jS, Y", strtotime($row['created'])).'
                                                           <br><br>
                                                           <span class="text-primary" >
                                                                '.$row['votes'].' User(s) have voted
                                                           </span>
                                                    </p>
                                                    <span class="text-right">';

                                            if($row['locked'] === 1)
                                            {
                                                echo '<br><b class="small text-muted">[Locked Poll]</b>';
                                            }
                                            else
                                            {
                                                echo '<br><b class="small text-success">[Open Poll]</b>';
                                            }

                                            echo '</span>
                                                    </div>';
                                        }
                                   }
                                ?>
                                  
                                </div>    

                            </div>

                            <div class="tab-pane fade" id="event" role="event" aria-labelledby="event-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/201.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Upcoming Events</h1>
                                  </div>
                                </div>  

                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    
                                  
                                </div>    

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-2">

                        <div class="text-center p-3 mt-5">
                            <a href="team.php" target="_blank">
                                <i class="creater-icon fa fa-users fa-5x" aria-hidden="true"></i>
                            </a>
                            <p><br>THE CREATORS</p>
                        </div>

                        <a href="forum.php" class="btn btn-warning btn-lg btn-block">Admin Notif</a>
                        <a href="hub.php" class="btn btn-secondary btn-lg btn-block">Service P. Notif</a>
                        <br><br><br>
                        <a href="create-topic.php" class="btn btn-warning btn-lg btn-block">Create a Branch</a>
                        <a href="create-blog.php" class="btn btn-secondary btn-lg btn-block">Create a Product</a>

                    </div>
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        

        
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" ></script>

        <script>
            var myVar;

            function pageLoad() {
              myVar = setTimeout(showPage, 4000);
            }

            function showPage() {
              document.getElementById("loader-wrapper").style.display = "none";
              document.getElementById("content").style.display = "block";
            }
        </script>  
        
    </body>
</html>