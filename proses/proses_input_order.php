<?php
session_start();
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";


if (!empty($_POST['input_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Meja telah di isi pelanggan lain"); window.location="../pesan"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order,pelanggan,meja,pelayan) values ('$kode_order','$pelanggan','$meja','$_SESSION[id_cafeku]')");
        if (!$query) {
            $message = '<script>alert("Data gagal dimasukan")window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>
            </script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukan");
        window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>
        </script>';
        }
    }
}
echo $message
?>