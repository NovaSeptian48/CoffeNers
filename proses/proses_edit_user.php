<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "" ;
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
$leveluser = (isset($_POST['leveluser'])) ? htmlentities($_POST['leveluser']) : "" ;
$telepon = (isset($_POST['telepon'])) ? htmlentities($_POST['telepon']) : "" ;
$password = md5('password') ;

if(!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn, "UPDATE tb_userc SET nama='$nama', username='$username', telepon='$telepon' WHERE id='$id'");
    if($query){
        // Jika kueri berhasil dieksekusi
        $message = '<script>alert("Data berhasil diupdate")
        window.location="../user"</script>';
    } else {
        // Jika kueri gagal dieksekusi
        $message = '<script>alert("Data gagal diupdate")
        window.location="../user"</script>';
    }


}echo $message
?>