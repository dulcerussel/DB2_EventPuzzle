<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Inbox | KLiK");
    
    if(!isset($_SESSION['SP_ID']))
    {
        header("Location: login.php");
        exit();
    }  
    
    include 'includes/HTML-head.php';
?> 


        <link href="css/inbox.css" rel="stylesheet">
    </head>
    
    <body>

        <?php include 'includes/navbar.php'; ?>
        
        <div class="cover">
            <div class="messaging">
              <div class="inbox_msg">
                <div class="inbox_people">
                  <div class="headind_srch">
                    <div class="recent_heading">
                      <h2>Inbox</h2>
                    </div>
                  </div>
                  <div class="inbox_chat">
                      
                      <?php
                
                          

                        $login_user = PDO_DB::query("select * from customer ", array(), "SELECT");
                                        if(count($login_user) > 0){
                                            foreach($login_user as $row)
                                            {
                        ?>
                      
                      <a href='./message.php?id=<?php echo $row['CUST_ID']; ?>'><div class="chat_list ">
                            <div class="chat_people">
                                <div class="chat_img"> 
                                    <img class="chat_people_img" src="uploads/<?php echo $row['image'] ?>"> 
                                </div>
                              <div class="chat_ib">
                                <h5>
                                    <?php echo ucwords($row['CUST_USERNAME']) ?> 
                                    <span class="chat_date">EventPuzzle</span>
                                </h5>
                                <p>Click on the User to start chatting</p>
                              </div>
                            </div>
                          </div></a>
                      
                        <?php
                               
                            }
                        }

                        ?>
                  </div>
                </div>
                  
                  
                  
                <div class="mesgs">
                    <div class="msg_history">
                      
                        
                        <?php
                            if(isset($_GET['id'])){

                                $user_two = $_GET['id'];

                                
                                    $login_user = PDO_DB::query("select * from business_message where sp_id =? and cust_id=?", array($_SESSION["SP_ID"],$user_two), "SELECT");
                                    


                                            if(count($login_user) > 0){
                                            foreach($login_user as $row)
                                            {

                                                
                                                $msg_id = $row['MSG_CONTENT'];

                                            }
                                            }
                                            
                                        
                             }       
                         
                        ?> 
                      
                     
                    
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
                        <input type="hidden" id="user_form" value="<?php echo base64_encode($_SESSION['userId']); ?>">
                        <input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">

                        <textarea id="message" type="text" class="write_msg form-control-plaintext" style="background-color: white;" 
                                  placeholder="Type a message"></textarea>

                        <button id="reply" class="msg_send_btn" 
                                type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
            
 

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>  
    </body>
</html>
