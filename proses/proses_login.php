<?php
    session_start();
    include "connect.php";
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
    $password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "" ;
    if(!empty($_POST['submit_validate'])){
        $query = mysqli_query($conn, "SELECT * FROM tb_userc WHERE username = '$username' && password = '$password'");
        $hasil = mysqli_fetch_array($query);
        if($hasil){
            $_SESSION['username_cafeku'] = $username;
            $_SESSION['leveluser_cafeku'] = $hasil['leveluser'];
            $_SESSION['id_cafeku'] = $hasil['id'];
            header('location:../home');
        } else { ?>
        <script>
            alert('Username atau Password salah');
            window.location = '../login'
        </script>
<?php
        }
    }
?>