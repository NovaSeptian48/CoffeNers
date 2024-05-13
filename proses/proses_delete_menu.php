<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$gambar = (isset($_POST['gambar'])) ? htmlentities($_POST['gambar']) : "";

if (!empty($_POST['delete_menu_validate'])) {
    $select = mysqli_query($conn, "SELECT menu FROM tb_list_order WHERE menu = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Menu pesanan tidak bisa di hapus"); window.location="../daftarmenu"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id='$id'");
        if ($query) {
            unlink("../assets/img/$gambar");
            // Jika kueri berhasil dieksekusi
            $message = '<script>alert("Menu berhasil dihapus")
        window.location="../daftarmenu"</script>';
        } else {
            // Jika kueri gagal dieksekusi
            $message = '<script>alert("Menu gagal dihapus")
        window.location="../daftarmenu"</script>';
        }
    }
}
echo $message
?>