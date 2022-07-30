<?php
require 'auth.php';


if(isset($_POST['post'])){
    $post = $obj_admin->post_notice($_POST);
}
$notices = $obj_admin->display('swastik_notices','notice_id');

$resources = $obj_admin->display('swastik_resources','resource_id');


if($_SESSION['user_permission']==0){
    $assignments = $obj_admin->display_('swastik_assignments','assi_faculty','assi_semester','assi_id');
}else{
    $assignments = $obj_admin->display('swastik_assignments','assi_id');
}
if(isset($_POST['download'])){
    $download = $obj_admin->download_assi($_POST);
}
if(isset($_POST['open'])){
    $open = $obj_admin->open_assi($_POST);
}






if(isset($_POST['upload-note'])){
    $post = $obj_admin->upload_note($_POST, $_FILES['note_file']);
    
}
if(isset($_POST['download'])){
    $download = $obj_admin->download_notes($_POST);
}
if(isset($_POST['open'])){
    $download = $obj_admin->open_notes($_POST);
}

if($_SESSION['user_permission']==0){
    $notes= $obj_admin->display_('swastik_notes','note_faculty','note_semester','note_id');
}else{
    $notes = $obj_admin->display('swastik_notes','note_id');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../style/style-d.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
</head>

<body>
    <div class="container">
        <div class="fixed-nav">
            <div class="left-div">
                <div class="fixed-logo">
                    <div class="logo-section"><img src="../img/swastik-logo-red.png"></div>
                </div>
                <div class="fixed-menu">
                    <div class="menu-section">
                        <li><a href="#" class="active"><i class="fa-solid fa-house"></i><span
                                    class="title">Home</span></a></li>
                        <li><a href="assignment.php"><i class="fa-solid fa-clipboard-list"></i><span
                                    class="title">Assignment</span></a></li>
                        <li><a href="notes.php"><i class="fa-solid fa-book-open"></i><span class="title">Notes</span></a></li>
                        <li><a href="notices.php"><i class="fa-solid fa-bullhorn"></i><span class="title">Notices</span></a></li>
                        <li><a href="feedback.php"><i class="fa-solid fa-comment"></i><span class="title">Feedback</span></a></li>
                        <li><a href="profile.php"><i class="fa-solid fa-user"></i><span class="title">Profile</span></a></li>
                        <li><a href="logout.php" onClick="return confirm('Are you sure you want to log out?')"><i class="fa-solid fa-arrow-right-from-bracket"></i><span class="title">Log Out</span>
              
                        </a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="title">
                <h3>HOME</h3>
               
            </div>

            <div class="contents">
            <?php
                    if($_SESSION['user_permission']==1){ ?>
    
    
                    <div class="notice post-assignment">
                        <form class="teachers-form" method="post" enctype="multipart/form-data">

                            <textarea name="notice_content" placeholder="Post Notice"></textarea>
                               
                            <input type="submit" name="post" value="Post">
                        </form>
                        <div class="message"><?php echo $post; ?></div>
                        
                    </div>
                     <?php } ?>
                <div class="topic-container">

                    Recent Notices
                </div>
                <?php if ($notices) { 
                    if($notices[0]['notice_id']==NULL){
                        echo "Nothing Found";
                    } else{
                for($i=0; $i<=3;$i++) { 
                    if($notices[$i]['notice_id']!=NULL) { 
                        $user_info = $obj_admin->edit("user_image","swastik_users","user_id",$notices[$i]['user_id']);
                        ?>
                <div class="notice-section">
                    <div class="user">
                        <img class="user-img" src="../user-img/<?php echo $user_info['user_image']; ?>">
                    </div>
                    <div class="notice-head">
                        <span class="author"><b>
                                <?php echo $notices[$i]['notice_author']; ?>
                            </b></span>
                        <span class="date">
                            <?php
                            
                            $time = $obj_admin->time_ago($notices[$i]['notice_date']);
                            
                            echo $time;
                            
                            ?>
                        </span>
                    </div>
                    <div class="notice-content">
                        <p>
                            <?php echo $notices[$i]['notice_content']; ?>
                        </p>
                    </div>



                    <div class="interact">
                      
                        <a class="like-icon" href="#like">
                            <?php echo $notice['likes']; ?><i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a class="like-icon" href="#like">
                            <?php echo $notice['dislikes']; ?><i  class="fa-regular fa-thumbs-down"></i>
                        </a>
                        <a class="reply-icon" href="#" id="reply-icon"
                            onclick="document.getElementById('id1').style.display='block'">
                            <?php echo $notice['comments']; ?><i class="fa-solid fa-reply"></i>
                        </a>
                    </div>

                </div>
                <?php  }}}} ?>
                


                <div class="topic-container">ASSIGNMENTS</div>
                <?php
                if($assi[0]['assi_id']==NULL){
                    echo "<div style='text-align:center'>Good News! No Assignments uploaded.</div>";
                 }else{
                for($i=0; $i<=3;$i++) { 
                    if($assi[$i]['assi_id']!=NULL) { ?>
                <div class="assignment-section">
                    <div class="flex-title assignment-title"><span><?php echo $assi[$i]['assi_title']; ?></span> 
                        <span class="date">
                        <?php
                            
                        $time = $obj_admin->time_ago($assi[$i]['assi_date']);
                        
                        echo $time;
                        
                        ?>  <span class="more"><i class="fa-solid fa-ellipsis-vertical"></i></span>    </span> </div>
                    <div class="assignment-desc"><?php echo $assi[$i]['assi_desc']; ?></div>
                    <div class="assignment-author">Posted By  <?php echo $assi[$i]['assi_author']; ?> </div>
                    
                    <?php if($assi[$i]['assi_file']!=NULL){ ?>
                    <form method="post">
                    <input type="hidden" name="id" value="<?php echo $assi[$i]['assi_id']; ?>">
                      <div class="flex-buttons">  
                     <input type="submit" name="open" value="Open">
                     
                     <input type="submit" name="download" value="Download">
                    </div>
                </form>
                <?php } ?>
                       
                        <div class="submission-date">Due Date: <b><?php echo $assi[$i]['assi_due_date']; ?></b></div>


                        <div class="interact">
                    </div>
                    

                </div>
                <?php }} }?>



                <div class="topic-container">NOTES</div>
                 <?php
                 if($note[0]['note_id']==NULL){
                    echo "<div style='text-align:center'>Bad News:( No Notes.</div>";
                 }else{
                for($i=0; $i<=3;$i++) { 
                    if($note[$i]['note_id']!=NULL) { ?>
                <div class="notes-section">
                    <div class="flex-title note-title"><span><?php echo $note[$i]['note_title']; ?></span> 
                        <span class="date">
                        <?php
                            
                        $time = $obj_admin->time_ago($note[$i]['note_date']);
                        
                        echo $time;
                        
                        ?>
                        <span class="more"><i class="fa-solid fa-ellipsis-vertical"></i></span>    </span> </div>
                    <div class="notice-author">Uploaded by <?php echo $note[$i]['note_author']; ?> 
                       .</div>
                    <div class="notes-buttons">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $note[$i]['note_id']; ?>">
                      <div class="flex-buttons">  
                     <input type="submit" name="open" value="Open">
                     
                     <input type="submit" name="download" value="Download">
                    </div>
                </form>

                </div>
                <div class="interact">
                    </div>

                </div>
                <?php }}} ?>



                
            </div>

        </div>

        <div class="right-div">
            <div class="title"><h3>Recommended External resources:</h3></div>
            <div class="resource-content">
                <ul>
                    <?php foreach($resources as $r){ ?>
                    <li><a href="<?php echo $r['resource_link'] ?>">🔰<?php echo $r['resource_title'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>



    </div>


</body>

</html>