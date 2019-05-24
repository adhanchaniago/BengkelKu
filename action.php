<?php
    session_start();                        
        $koneksi = new mysqli('localhost', 'root', '','dbservice');

    $username=$_POST['username'];           
    $password=$_POST['password'];           

    $query=mysqli_query($koneksi, "select * from user where nama='$username' and password='$password'");    
    if($query==TRUE){                             
        $_SESSION['username']=$username;      
        header("location:index.php");         
    }else{                                   
        echo "gagal login";
    }

?>