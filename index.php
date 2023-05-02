<?php
    include "templates/db.php";

    $page = "home";

    $login = "";

    $password = "";

    $online = false;

    session_start();

    if(isset($_GET['page'])){
        if($_GET['page'] == "home"){
            $_SESSION['page'] = $page;
            $page = "home";
        }else if($_GET['page'] == "registration"){
            $_SESSION['page'] = $page;
            $page = "registration";
        }
    }

    if(isset($_SESSION['user'])){ 

        $user = $_SESSION['user']; 

            $add = "SELECT * FROM users WHERE id =\"".$user['id']."\" AND password =\"".$user['password']."\""; 


            $queryy = $connection->query($add); 

                if( $row = $queryy->fetch_array() ){
                            $_SESSION['user'] = $row;   // $_SESSION['user']['id']     $_SESSION['user']['login'];
                            $page = "myPage";
                            $online = true;
                }
        
    } 

    if($online){

        if( isset($_GET['page']) ){
            if( $_GET['page'] == "myPage" ){
                $page = "myPage";
            }else if($_GET['page'] == "Settings"){
                $page = "Settings";
            }
        }

        if ( isset($_GET['act']) ){
            if($_GET['act'] == "post_pic"){

            $user_id = $_SESSION['user']['id'];

            $temp_file = $_FILES['picture_upload'];
            
            $salt = "senanurzhan_^_^";
            
            $file_name = sha1(rand(0,1500)+$salt).".jpg";
            
            move_uploaded_file($_FILES['picture_upload']['tmp_name'],"img/$file_name");

            $connection->query("INSERT INTO pictures(id,user_id,url,post_date,active)
                                    VALUES(NULL,\"$user_id\",\"$file_name\",NOW(),1)");


            }else if($_GET['act'] == "edit"){

                    $_id = $_SESSION['user']['id'];

                    $query = $connection->query("SELECT * FROM users WHERE id = $_id");
                    if($row=$query->fetch_object()){
                        $login = $_POST['login'];
                        $password = sha1($_POST['password']);
                        $name = $_POST['name'];
                        $surname = $_POST['surname'];
                        $age = $_POST['age'];
                        $query = $connection->query("UPDATE users SET login = \"$login\", password = \"$password\",name = \"$name\",surname = \"$surname\",age = \"$age\" WHERE id = $_id ");
                    }

            }else if($_GET['act'] == "del"){

                $_id = $_SESSION['user']['id'];
                $t_id = $_GET['id'];
                $delete = $connection->query("DELETE * FROM pictures WHERE user_id = $_id AND id = $t_id");
                $upd = $connection->query("UPDATE pictures SET active = 0 WHERE user_id = $_id AND id = $t_id");
                
            }else if($_GET['act'] == "com"){

                $userid = $_SESSION['user']['id'];
                $tid = $_POST['t_id'];
                $comment = $_POST['comment'];
                $lol = "INSERT INTO `comments`(`id`, `user_id`, `picture_id`, `text_com`, `post_date`, `active`) 
                        VALUES (NULL,$userid,$tid, \"$comment\", NOW(), 1 )";                       
                $connection->query($lol);
                $page = "myPage";



            }else if($_GET['act'] == "logout"){

                $online = false;
                Unset($_SESSION['user']);
                $page = "home";

            }else if($_GET['act'] == "deactive"){

                $user_id = $_SESSION['user']['id'];
                $deactive = $connection->query("UPDATE users SET active = 0 WHERE id = $user_id ");

                $online = false;
                $page = "home";

            }else if($_GET['act'] == "backto"){

                $page = "myPage";

            }else if($_GET['act'] == "cdel"){

                    $_user_id = $_SESSION['user']['id'];
                    $_p_id = $_GET['t_id'];
                    $_c_id = $_GET['c_id'];
                    $del = $connection->query("DELETE FROM comments WHERE user_id = $_user_id AND picture_id = $_p_id AND id = $_c_id");
            }
        }    

    }else{

        if(isset($_GET['act'])){
            if($_GET['act'] == 'login'){
                $login = $_POST['login'];
                $password = sha1($_POST['password']);
                $query = $connection->query("SELECT id,login,password FROM users WHERE login = \"$login\" AND password = \"$password\" AND active = 1 ");

                if( $row = $query->fetch_array() ){
                    $_SESSION['user'] = $row;   // $_SESSION['user']['id']     $_SESSION['user']['login'];
                    $page = "myPage";
                    $online = true;
                }else{
                    $page = "home";
                    $online = false;
                }
            }else if ($_GET['act'] == 'reg') {

                $login = $_POST['login'];
                $password = sha1($_POST['password']);
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $age = $_POST['age'];
                //echo("INSERT INTO users(id,name,surname,login,password,age,active)
                //                 VALUES(NULL,\"$name\",\"$surname\",\"$login\",\"$password\",STR_TO_DATE('$age', '%Y/%m/%d'),1)");
                $connection->query("INSERT INTO users(id,name,surname,login,password,age,active)
                                    VALUES(NULL,\"$name\",\"$surname\",\"$login\",\"$password\",\"$age\",1)");

            }if($_GET['act'] == 'regis'){

                $page = "registration";
               
            }else if($_GET['act'] == 'back'){

                $page = "home";

            }
        }                
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Instagram</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bootstrap/css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">Instagram</div>

     <?php
    
        if($online){
            include 'templates/header-menu.php';
        }    
    ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">

                    <?php
                
                    if($online == true){
                        include 'pages/logged/'.$page.'.php';

                    }else if($online == false){ 
                        include 'pages/notlogged/'.$page.'.php';
                    }
                
                    ?>

                </div>

            </div>
        </div>

    </div>
    <!-- /.container -->
       <?php

            include 'templates/footer.php';
        ?>

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>