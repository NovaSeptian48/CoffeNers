<?php
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";

if (!empty($_POST['delete_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Pesanan ini memiliki list pesanan, Pesanan tidak bisa di hapus"); window.location="../pesan"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order='$kode_order'");
        if ($query) {
            // Jika kueri berhasil dieksekusi
            $message = '<script>alert("Data berhasil dihapus")
        window.location="../pesan"</script>';
        } else {
            // Jika kueri gagal dieksekusi
            $message = '<script>alert("Data gagal dihapus")
            window.location="../pesan"</script>';
        }
    }
}
echo $message
?>