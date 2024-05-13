<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;

if(!empty($_POST['delete_user_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_userc WHERE id='$id'");
    if($query){
        // Jika kueri berhasil dieksekusi
        $message = '<script>alert("Data berhasil dihapus")
        window.location="../user"</script>';
    } else {
        // Jika kueri gagal dieksekusi
        $message = '<script>alert("Data gagal dihapus")
        window.location="../user"</script>';
    }


}echo $message
?>