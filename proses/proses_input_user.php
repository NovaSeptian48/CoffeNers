<?php
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$leveluser = (isset($_POST['leveluser'])) ? htmlentities($_POST['leveluser']) : "";
$telepon = (isset($_POST['telepon'])) ? htmlentities($_POST['telepon']) : "";
$password = md5('password');

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_userc WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username telah digunakan")
        window.location="../user"</script></script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_userc (nama,username,leveluser,telepon,password) values ('$nama','$username','$leveluser','$telepon','$password')");
        if (!$query) {
            $message = '<script>alert("Data gagal dimasukan")
        window.location="../user"</script></script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukan");
        window.location="../user"</script>
        </script>';
        }
    }
}
echo $message
?>