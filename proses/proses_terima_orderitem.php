<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;


if(!empty($_POST['terima_orderitem_validate'])){
        $query = mysqli_query($conn, "UPDATE tb_list_order SET status=1 WHERE id_list_order ='$id'");
        if (!$query) {
            $message = '<script>alert("Gagal menerima pesanan")
            window.location="../dapur"</script>
        </script>';
        } else {
            $message = '<script>alert("Berhasil menerima pesanan");
        window.location="../dapur"</script>
        </script>';
        }
    }

echo $message
?>