<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Daftar menu
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="<?php echo ($_SESSION['leveluser_cafeku'] == 3) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#ModalTambahMenu">Tambah menu</button>
                </div>
            </div>
            <!-- Modal tambah menu -->
            <div class="modal fade" id="ModalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Tambah menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3 ">
                                            <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your name" name="gambar" required>
                                            <label class="input-group-text" for="uploadfoto">Upload gambar</label>
                                            <div class="invalid-feedback">
                                                Masukan gambar menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama menu" name="nama_menu" required>
                                            <label for="floatingInput">Nama menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Keterangan" name="keterangan" required>
                                            <label for="floatingInput">Keterangan menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Keterangan menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kategori" required>
                                                <option selected hidden value="">Pilih kategori</option>
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                            </select>
                                            <label for="floatingInput">Kategori menu</label>
                                            <div class="invalid-feedback">
                                                Pilih Kategori menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxx" name="harga" required>
                                            <label for="floatingInput">Harga menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Harga menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Tambah menu</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end Modal tambah menu -->
            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
            ?>



                    <!-- Modal delete -->
                    <div class="modal fade" id="ModalDeleteMenu<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <input type="hidden" value="<?php echo $row['gambar'] ?>" name="gambar">
                                        <div class="col-lg-12">
                                            Apakah anda yakin ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_menu_validate" value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end  Modal delete -->
                <?php
                }


                ?>
                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">==</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td>
                                        <div style="width: 90px">
                                            <img src="assets/img/<?php echo $row['gambar'] ?>" class="img-fluid" alt="...">
                                    </td>
                </div>

                <td><?php echo $row['nama_menu'] ?></td>
                <td><?php echo $row['keterangan'] ?></td>
                <td><?php echo ($row['kategori'] == 1) ? "Makanan" : "Minuman" ?></td>
                <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                <td>
                    <div class="d-flex">
                        <button class="<?php echo ($_SESSION['leveluser_cafeku'] == 3) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDeleteMenu<?php echo $row['id'] ?>"><i class="bi bi-trash3"></i></button>
                    </div>
                </td>
                </tr>
            <?php
                            }
            ?>
            </tbody>
            </table>
        </div>
    <?php
            }
    ?>
    </div>
</div>

</div>

