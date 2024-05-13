<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "" ;
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "" ;
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "" ;
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "" ;
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "" ;


if(!empty($_POST['edit_orderitem_validate'])){
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu',jumlah='$jumlah' WHERE id_list_order ='$id'");
        if (!$query) {
            $message = '<script>alert("Data gagal dimasukan")
            window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>
        </script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukan");
        window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>
        </script>';
        }
    }

echo $message
?>