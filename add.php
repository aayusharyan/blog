<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$info = $_POST['info'];
$dt = date('Y/m/d');
$con=mysqli_connect("mysql.hostinger.in","u146795210_jobs","password", "u146795210_jobs");
if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
$sql = "INSERT INTO blog (by_name, by_mail, blog, date)
VALUES ('$name', '$by_mail', '$info', $'$dt')";
if (mysqli_query($con, $sql)) 
    {        
                $qz2 = "SELECT * FROM blog where by_name='".$name."' and by_mail='".$mail."' and info='".$info."' and dt='".$dt."'";
                $qz2 = str_replace("\'","",$qz2);
                $result3 = mysqli_query($con,$qz2);
                while($row2 = mysqli_fetch_array($result3))
                    {
                        $id = $row2['id'];
                    }
                $sql5 = "CREATE TABLE ".$id."_replies (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `date` datetime NOT NULL,
                `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
                `mail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
                `reply` longtext COLLATE utf8_unicode_ci NOT NULL,
                PRIMARY KEY (`id`)
                )";
                if (mysqli_query($con, $sql5)) 
                    {
                        $_SESSION['return'] =  "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                         Job Was Successfully Created.
                                        </div>";
                        header("Location: new.php");
                    }
                else
                    {
                        $_SESSION['return'] = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
                                       <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                       There was an Error Adding the Job Completely, Please <strong>Delete</strong> the Last Created Job.
                                       </div>";
                        header("Location: new.php");
                    }
            }
        else 
            {
                $_SESSION['return'] = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
                                       <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                       There was an Error Adding the Job
                                       </div>";
                header("Location: new.php");
            } 
    mysqli_close($con);
?>