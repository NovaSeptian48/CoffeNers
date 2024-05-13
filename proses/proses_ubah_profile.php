<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "" ;
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
$leveluser = (isset($_POST['leveluser'])) ? htmlentities($_POST['leveluser']) : "" ;
$telepon = (isset($_POST['telepon'])) ? htmlentities($_POST['telepon']) : "" ;
$password = md5('password') ;

if(!empty($_POST['ubah_profile_validate'])){
    $query = mysqli_query($conn, "UPDATE tb_userc SET nama='$nama', telepon='$telepon' WHERE username = '$_SESSION[username_cafeku]'");
            if ($query) {
                $message = '<script>alert("Profile berhasil diubah");
            window.history.back()</script>';
            } else { 
                $message = '<script>alert("Profile gagal diubah");
            window.history.back()</script>';
            }
        }else{
            $message = '<script>alert("Terjadi kesalahan");
            window.history.back()</script>';
            
        }
echo $message
?>