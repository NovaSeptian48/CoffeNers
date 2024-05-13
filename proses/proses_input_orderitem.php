<?php
session_start();
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";


if (!empty($_POST['input_orderitem_validate'])) {
    if ($jumlah == 0) {
        $message = '<script>alert("Jumlah tidak boleh 0");
        window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>
        </script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order = '$kode_order'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("List menu telah ada"); window.location="../?x=orderitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '&meja=' . $meja . '"</script>';
        } else {
            $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu,kode_order,jumlah) values ('$menu','$kode_order','$jumlah')");
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
    }
}
echo $message
?>