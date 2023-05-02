<!DOCTYPE html>
<html>
<head>
</head>
<body>

    <div class = "col-lg-12">
        <hr>
        <h2 class="intro-text text-center">
            <strong> P I C T U R E S </strong>
        </h2>
        <hr><br>

        <form action="?act=post_pic" method="post" enctype="multipart/form-data">
            <span class="btn btn-default btn-file" style = "width:600px ; background-color:#ddffcc">
               <h4 style = "color:#008000">Select File :</h4>
                <input type="file" name="picture_upload" id="fileToUpload">
                <input type="submit" name="submit" value="Upload" style = "float:right; font-size:17px ; color:#006600">
            </span>
        </form><br><br>
    </div>

        <?php
        $query = $connection->query("SELECT * FROM pictures WHERE active = 1");
        while($row=$query->fetch_object()){
            if($row->active){
                $id_author = $row->user_id;
                $id_picture = $row->id;
                $query_user = $connection->query("SELECT id, name,surname FROM users WHERE id = \"$id_author\"");
                if($row_user=$query_user->fetch_object()){
                    echo "<h2>".$row_user->name." ".$row_user->surname." : </h2>";
                }
                
                echo '<img src="img/'.$row->url.'".jpg">'.'<br>';
                echo "<br>"."<strong><b>".$row->post_date." </b></strong>".'<br><br>';

                if($id_author == $_SESSION['user']['id']){
                ?>
                    <form action = "?act=del&id=<?php echo $row->id;?>" method ="POST">
                        <input type="hidden" name="del" value="<?php echo $row->id; ?>"></input>
                        <button type="submit" class="btn btn-success">Delete</button>
                    </form>
                <?php

                }?>
                
                

                <?php

                    $query_com = $connection->query("SELECT * FROM comments WHERE picture_id = $row->id");
                    while($row_com = $query_com->fetch_object()){
                        if($row_com->active){
                            $query_user_com = $connection->query("SELECT id,name,surname FROM users WHERE id = $row_com->user_id");
                            if($row_user_com = $query_user_com->fetch_object()){
                                echo "<strong><b>".$row_user_com->name.' '.$row_user_com->surname.' '." : "." </b></strong>".'<br>';
                            }

                            echo "<strong><h5><b>".$row_com->text_com."</b></strong></h5>".'<br>';
                            echo $row_com->post_date.'<br>';

                            if($row_com->user_id==$_SESSION['user']['id']){
                                echo '<a href="?act=cdel&c_id='.$row_com->id.'&t_id='.$row->id.'">Delete</a><br>';
                            }
                            
                        }
                    }


                ?>


                <br><h4>Leave a Comment:</h4>
                    <form action = "?act=com" method = "POST">
                        <div class="form-group">
                            <input type="text" name="comment" id="email" class="form-control input-sm" style = "width:700px ; float:left ; margin-left:70px">
                        </div>
                        <input type="hidden" name="t_id" value="<?php echo $row->id; ?>" ></input>
                    <button type="submit" class="btn btn-primary" style = "background-color:#006600">Submit</button>
                    </form><br><hr><br>

                <?php

            }
        }
    ?>    
    
</body>
</html>