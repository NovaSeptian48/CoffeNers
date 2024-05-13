<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;


if(!empty($_POST['siapsaji_orderitem_validate'])){
        $query = mysqli_query($conn, "UPDATE tb_list_order SET status=2 WHERE id_list_order ='$id'");
        if (!$query) {
            $message = '<script>alert("Pesanan belum siap disajikan")
            window.location="../dapur"</script>
        </script>';
        } else {
            $message = '<script>alert("Pesanan siap disajikan");
        window.location="../dapur"</script>
        </script>';
        }
    }

echo $message
?>