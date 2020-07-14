
<?php

    session_start();
    include_once 'includes/dbh.inc.php';
    define('TITLE',"Dashboard| Event Puzzle");

    $companyName = "Franklin's Fine Dining";

    //$sp_id = isset($_SESSION['sp_id']);
    
    function strip_bad_chars( $input ){
        $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
        return $output;
    }
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?> 
        <link href="css/list-page.css" rel="stylesheet">
        <link href="css/loader.css" rel="stylesheet">
    </head>
    
    <body onload="pageLoad()">
        
        <div id="loader-wrapper">
        <img src='img/500.png' id='loader-logo'>
            <div class="loader">
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__ball"></div>
            </div>
        </div>
        
        <div id="content" style="display: none">
            
            <?php include 'includes/navbar.php'; ?> 
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3" >

                        <?php include 'includes/profile-card.php'; ?>

                    </div>

                    <div class="col-sm-7" >

                        <div class="text-center p-3">
                            <img src="img/200.png">
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
                                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Orders</h1>
                                  </div>
                                </div>  

                                    <div class="row mb-2">

                                    <?php
                                        $sql = "select topic_id, topic_subject, topic_date, topic_cat, topic_by, userImg, idUsers, uidUsers, cat_name, (
                                                    select sum(post_votes)
                                                    from posts
                                                    where post_topic = topic_id
                                                    ) as upvotes
                                                from topics, users, categories 
                                                where topics.topic_by = users.idUsers
                                                and topics.topic_cat = categories.cat_id
                                                order by topic_id desc, upvotes asc 
                                                LIMIT 6";
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
                                                echo '<div class="col-md-6">
                                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                        <a href="posts.php?topic='.$row['topic_id'].'">
                                                        <img class="card-img-left flex-auto d-none d-lg-block blogindex-cover" 
                                                                src="img/forum-cover.png" alt="Card image cap">
                                                                </a>
                                                          <div class="card-body d-flex flex-column align-items-start">
                                                            <strong class="d-inline-block mb-2 text-primary text-center  ml-auto">
                                                                <i class="fa fa-chevron-up" aria-hidden="true"></i><br>'.$row['upvotes'].'
                                                            </strong>
                                                            <h6 class="mb-0">
                                                              <a class="text-dark" href="posts.php?topic='.$row['topic_id'].'">'
                                                                .substr(ucwords($row['topic_subject']),0,15).'...</a>
                                                            </h6>
                                                            <small class="mb-1 text-muted">'.date("F jS, Y", strtotime($row['topic_date'])).'</small>
                                                            <small class="card-text mb-auto">Created By: '.ucwords($row['uidUsers']).'</small>
                                                            <a href="posts.php?topic='.$row['topic_id'].'">Go To Forum</a>
                                                          </div>

                                                        </div>
                                                      </div>';
                                            }
                                        }
                                    ?>        


                                </div>

                            </div>

                            <div class="tab-pane fade" id="blog" role="blog" aria-labelledby="blog-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Products</h1>
                                  </div>
                                </div>  

                                <div class="row mb-2">

                                    <?php

                                        $sql = "select * from product 
                                                where sp_id = sp_id
                                                order by prod_price desc
                                                LIMIT 6";

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
                                                echo '<div class="col-md-6">
                                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                          <div class="card-body d-flex flex-column align-items-start">
                                                            <h6 class="mb-0">
                                                              <a class="text-dark" href="blog-page.php?id='.$row['prod_id'].'">'.substr($row['prod_name'],0,10).'...</a>
                                                            </h6>
                                                            <small class="mb-1 text-muted">'.$row['prod_price'].'</small>
                                                            <small class="card-text mb-auto">'.substr($row['prod_description'],0,40).'...</small>   
                                                            <a href="blog-page.php?id='.$row['prod_id'].'">Continue reading</a>
                                                          </div>
                                                          <a href="blog-page.php?id='.$row['prod_id'].'">
                                                          <img class="card-img-right flex-auto d-none d-lg-block blogindex-cover" 
                                                                src="uploads/'.$row['image'].'" alt="Card image cap">
                                                                    </a>
                                                        </div>
                                                      </div>';
                                            }
                                        }
                                    ?>        


                                </div>

                            </div>

                            <div class="tab-pane fade" id="poll" role="poll" aria-labelledby="poll-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Latest Branches</h1>
                                  </div>
                                </div>  

                                <div class="my-3 p-3 bg-white rounded shadow-sm">

                                  <?php

                                    $sql = "select *  from service_provider_branch_address
                                                where 
                                                sp_id = sp_id 
                                            order by spba_city desc
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

                                            echo '<a href="poll.php?poll='.$row['sp_id'].'">
                                                <div class="media text-muted pt-3">
                                                    <img src="img/'.ucwords($row['image']).' alt="" class="mr-2 rounded div-img poll-img">
                                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray ">
                                                      <strong class="d-block text-gray-dark">'.ucwords($row['spba_city']).'</strong></a>
                                                          '.ucwords($row['spba_barangay']).'
                                                           <br><br>
                                                           <span class="text-primary" >
                                                                '.$row['votes'].' User(s) have voted
                                                           </span>
                                                    </p>
                                                    <span class="text-right">';

                                            echo '</span>
                                                    </div>';
                                        }
                                   }
                                ?>

                                </div>    

                            </div>

                            <div class="tab-pane fade" id="event" role="event" aria-labelledby="event-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Event Calendar</h1>
                                  </div>
                                </div>  

                            </div>

                            <div class="tab-pane fade" id="reports" role="reports" aria-labelledby="event-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                                  <div class="lh-100">
                                    <h1 class="mb-0 text-white lh-100">Summary Report</h1>
                                  </div>
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

                        <a href="forum.php" class="btn btn-warning btn-lg btn-block">KLiK Forum</a>
                        <a href="hub.php" class="btn btn-secondary btn-lg btn-block">KLiK Hub</a>
                        <br><br><br>
                        <a href="create-topic.php" class="btn btn-warning btn-lg btn-block">Create a Branch Address</a>
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