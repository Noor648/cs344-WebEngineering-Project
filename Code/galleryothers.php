<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>elite - A Good Social Site</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Our stylesheet -->
    <link rel="stylesheet" href="css/style.css" <?php echo time(); ?>>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">


</head>

<body>
    <nav id="navbar">
        <a href="#" class="nav-logo">
            <img src="img/logo.svg" alt="">
        </a>
        <a href="#"  class="f-right clearl">
            <img src="assets/icons-settings.svg" alt="" id="menu-pop" class="settings" onclick="appear();">
        </a>
    </nav>
    <div id="profile-content">
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1">
                        <div class="form-profile">
                        <?php
                            
                            session_start();
                            $conn = mysqli_connect('localhost','elite','','cs344_project');
                            $mail_g = $_SESSION["mail"];
                            $_SESSION["mail"] = $mail_g;
                            

                            $mail_p = $_GET["mail"];
                            $sql1 = "SELECT userName,e_mail FROM login where e_mail='".$mail_p."' ";
                            $result1 = mysqli_query($conn,$sql1) or die( mysqli_error($conn));
                            $row1 = mysqli_fetch_array($result1);

                            $sql2 = "SELECT * FROM profile JOIN login using (user_id) where  e_mail='".$mail_p."' ";
                            $result2 = mysqli_query($conn,$sql2) or die( mysqli_error($conn));
                            $row2 = mysqli_fetch_array($result2);

                            $image1 = $row2['cover_url'];
                            if (empty($image1)) $image1 = "default.jpg";
                            $image2 = $row2['profile_url'];
                            if (empty($image2)) $image2 = "default2.jpg";

                            $url1= "aboutothers.php?mail=" . $mail_p;
                            $url2= "friendsothers.php?mail=" . $mail_p;
                            $url3= "galleryothers.php?mail=" . $mail_p;

                            ?> 
                            <div class="cover">
                    
                                <img src= <?php echo $image1 ?> class="ProfilePic1">
                                
                            </div>

                            <div class="profile2-div ">
                                <div class="profile2-div2">

                                    <a href="#">
                                    <img src= <?php echo $image2 ?> alt="Avatar" class="ProfilePic2">
                                    </a>
                                </div>
                            </div>

                            <div class="user clearl">
                                <a href="profile.html">
                                <b><?php echo $row1['userName'] ?></b> 
                                </a>
                            </div>

                            <div class="username  clearl" id="use">
                                <a href="profile.html">
                                <?php echo $row1['e_mail'] ?>
                                </a>
                            </div>

                            <div class="Profilelist-div">
                                <br>
                                <ul class="Profilelist">
                                        <li class="left">
                                        <a href="<?php echo $url1 ?>">About</a>
                                        </li>
                                        <li class="left">
                                        <a href="<?php echo $url2 ?>">Friends</a>
                                        </li>
                                        <li class="left">
                                        <a href="<?php echo $url3 ?>">Gallery</a>
                                        </li>
                                       
                                    </ul>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1">
                        <div class="tags">Gallery</div>
                        
                        <div class="gallery-section">
                            
                            <div class="inner-width">
                                <div class="gallery">
                                    <?php

                                     $mail_p = $_GET["mail"];
                                     $path = "SELECT user_id,e_mail FROM login where e_mail='".$mail_p."' ";
                                     $resultp = mysqli_query($conn,$path) or die( mysqli_error($conn));
                                     $rowp = mysqli_fetch_array($resultp);
                                     $required_id= $rowp['user_id'];

                                
                                     
                                     $path2 = "SELECT * FROM gallery WHERE user_id='$required_id' " ;
                                     $resultp2 = mysqli_query($conn,$path2) or die( mysqli_error($conn));
                                     while($rowp2 = mysqli_fetch_array($resultp2)){
                                         $gimg = $rowp2['gallery_url'];
                                    ?>
                                    <a href="<?php echo "img/".$gimg ?>" class="image">
                                        <img src="<?php echo "img/".$gimg ?>" alt="">
                                    </a>
                                    <?php
                                     }
                                     ?>     
                                   
                              </div>
                         </div>
                     </div>
                      </div>
                 </div>
                       
        </section>
        <div onclick="close1();" class="bg-modal1" id="myDiv">
            <div class="menu">
                <ul>
                    <li class="clear"><a href="profile.php">Profile</a></li>
                    <li class="clear"><a href='home.php'>Home</a></li>
                    <li class="clear"><a href="notifications.php">Notifications</a></li>
                    <li class="clear"><a href="signout.php">Signout</a></li>
                    <li onclick="close1();"  ><a href="" id="close">Cancel</a></li>      
                </ul>
            </div> 
        </div>
    </div>
    <script>
        
        function appear(){  

        document.getElementById("myDiv").classList.toggle("bg-modal2");

        }

        function close1(){
        document.getElementById("myDiv").classList.toggle("bg-modal2");;
        }

        $(".gallery").magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery:{
        enabled: true
        }

        });
    </script>

</body>

</html>