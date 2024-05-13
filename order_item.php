<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya,SUM(nominal_uang-total_bayar) AS kembalian, tb_bayar.waktu_bayar FROM tb_list_order 
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_list_order
HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode = $record['id_order'];
    //$meja = $record['meja'];
    //$pelanggan = $record['pelanggan'];
}
$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            List Pesanan
        </div>
        <div class="card-body">
            <a href="pesan" class="btn btn-info mb-3"><i class="bi bi-chevron-double-left"></i></a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeorder" value=<?php echo $kode; ?>>
                        <label for="floatingInput">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value=<?php echo $pelanggan; ?>>
                        <label for="floatingInput">Pelanggan</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="meja" value=<?php echo $meja; ?>>
                        <label for="floatingInput">Meja</label>
                    </div>
                </div>


                <!-- Modal tambah item Pesanan -->
                <div class="modal fade" id="tambahPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan Makanan dan Minuman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="menu" id="">
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Menu makanan/minuman</label>
                                                <div class="invalid-feedback">
                                                    Masukan Menu
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="1xxxx" name="jumlah" required>
                                                <label for="floatingInput">Jumlah porsi</label>
                                                <div class="invalid-feedback">
                                                    Tambahkan Jumlah Porsi
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_orderitem_validate" value="12345">Tambah Pesanan</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end Modal item tambah pesanan -->
                <?php
                if (empty($result)) {
                    echo "Pesanan makanan dan minuman belum di tambahkan";
                } else {

                    foreach ($result as $row) {
                ?>

                        <!-- Modal edit -->
                        <div class="modal fade" id="ModalEditList<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit List Pesanan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                            <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                            <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="menu" id="">
                                                            <option selected hidden value="">Pilih Menu</option>
                                                            <?php
                                                            foreach ($select_menu as $value) {
                                                                if ($row['menu'] == $value['id']) {
                                                                    echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                                } else {
                                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="menu">Menu makanan/minuman</label>
                                                        <div class="invalid-feedback">
                                                            Masukan Menu
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="floatingInput" placeholder="1xxxx" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                        <label for="floatingInput">Jumlah porsi</label>
                                                        <div class="invalid-feedback">
                                                            Tambahkan Jumlah Porsi
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="edit_orderitem_validate" value="12345">Tambah Pesanan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end  Modal edit -->

                        <!-- Modal delete -->
                        <div class="modal fade" id="ModalDeleteList<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus List Pesanan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate action="proses/proses_delete_orderitem.php" method="POST">
                                            <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                            <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                            <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                            <div class="col-lg-12">
                                                Apakah anda yakin ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="12345">Hapus</button>
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

                    <!-- Modal Bayar Pesanan -->
                    <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Menu</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($result as $row) {
                                                ?>
                                                    <tr>

                                                        <td><?php echo $row['nama_menu'] ?></td>
                                                        <td><?php echo number_format((int)$row['harga'], 0, ',', '.')  ?></td>
                                                        <td><?php echo $row['jumlah'] ?></td>
                                                        <td><?php echo number_format((int)$row['harganya'], 0, ',', '.')  ?></td>


                                                    </tr>
                                                <?php
                                                    $total += $row['harganya'];
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="3" class="fw-bold">
                                                        Total Harga
                                                    </td>
                                                    <td class="fw-bold">
                                                        <?php echo number_format($total, 0, ',', '.')  ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <input type="hidden" name="total" value="<?php echo $total ?>">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="1xxxx" name="uang" required>
                                                    <label for="floatingInput">Nominal Pembayaran</label>
                                                    <div class="invalid-feedback">
                                                        Tambahkan Nominal Pembayaran
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="bayar_validate" value="12345">Bayar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end Modal Bayar pesanan -->

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-nowrap">

                                    <th scope="col">Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($result as $row) {
                                ?>
                                    <tr>

                                        <td><?php echo $row['nama_menu'] ?></td>
                                        <td><?php echo number_format((int)$row['harga'], 0, ',', '.') ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php
                                            if ($row['status'] == 1) {
                                                echo "<span class='badge text-bg-warning'>masuk dapur</span>";
                                            } elseif ($row['status'] == 2) {
                                                echo "<span class='badge text-bg-success'>siap saji</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo number_format((int)$row['harganya'], 0, ',', '.')  ?></td>

                                        <td>
                                            <div class="d-flex">
                                                <button class="<?php echo (!empty($row['id_bayar']) || $_SESSION['leveluser_cafeku'] == 2) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-info btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEditList<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="<?php echo (!empty($row['id_bayar']) || $_SESSION['leveluser_cafeku'] == 2) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDeleteList<?php echo $row['id_list_order'] ?>"><i class="bi bi-trash3"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $row['harganya'];
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="fw-bold">
                                        Total Harga
                                    </td>
                                    <td class="fw-bold">
                                        <?php echo number_format($total, 0, ',', '.')  ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }

                ?>
                <div class="mt-2">
                    <button class="<?php echo (!empty($row['id_bayar']) || $_SESSION['leveluser_cafeku'] == 2) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#tambahPesanan"><i class="bi bi-plus-circle"></i> Pesanan</button>
                    <button class="<?php echo (!empty($row['id_bayar']) || $_SESSION['leveluser_cafeku'] == 3) ? "btn btn-secondary disabled" : "btn btn-warning"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-currency-bitcoin"></i>Bayar</button>
                    <button onclick="printStruk()" class="<?php echo ($_SESSION['leveluser_cafeku'] == 3) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>"><i class="bi bi-printer"></i> Cetak Struk</button>
                </div>
            </div>
        </div>

    </div>



    <div id="strukContent" class="d-none">
        <style>
            #struk {
                font-family: 'Courier New', Courier, monospace;
                font-size: 14px;
                max-width: 300px;
                border: 1px solid #ccc;
                padding: 10px;
                width: 100mm;
            }

            #struk h2 {
                font-size: 18px;
                text-align: center;
                color: #333;
            }

            #struk p {
                margin: 10px 0;
            }

            #struk table {
                font-size: 14px;
                border-collapse: collapse;
                margin-top: 20px;
                margin-bottom: 20px;
                width: 100%;
            }

            #struk th,
            #struk td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            #struk .total {
                font-weight: bold;
            }
        </style>
        <div id="struk">
            <h2>Struk Pembayaran CoffeNers</h2>
            <p>Kode Pesanan : <?php echo $kode ?></p>
            <p>Pelanggan : <?php echo $pelanggan ?></p>
            <p>Waktu Bayar : <?php
                            if (!empty($row['id_bayar'])) {
                                echo date('d/m/Y', strtotime($result[0]['waktu_bayar']));
                            } else{
                                echo "-";
                            }
                            ?>

            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($result as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['nama_menu'] ?></td>
                            <td><?php echo number_format((int)$row['harga'], 0, ',', '.') ?></td>
                            <td><?php echo $row['jumlah'] ?></td>
                            <td><?php echo number_format((int)$row['harganya'], 0, ',', '.') ?></td>
                        </tr>
                    <?php
                        $total += $row['harganya'];
                    }
                    ?>
                    <tr class="total">
                        <td colspan="3">
                            Total Harga
                        </td>
                        <td>
                            <?php echo number_format($total, 0, ',', '.')  ?>
                        </td>
                    </tr>

                    <tr class="total">
                        <td colspan="3">
                            Bayar
                        </td>
                        <td>
                            <?php
                            if (!empty($row['id_bayar'])) {
                                echo number_format($row['nominal_uang'], 0, ',', '.');
                            } else{
                                echo "0";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr class="total">
                        <td colspan="3">
                            Kembalian
                        </td>
                        <td>
                        <?php
                            if (!empty($row['id_bayar'])) {
                                echo number_format($row['kembalian'], 0, ',', '.');
                            } else{
                                echo "0";
                            }
                            ?>
                    </tr>

                </tbody>
            </table>
            <p>=Terima sudah datang ke CoffeNers=</p>
        </div>
    </div>

    <script>
        function printStruk() {
            var strukContent = document.getElementById("strukContent").innerHTML;
            var printFrame = document.createElement('iframe');
            printFrame.style.display = 'none';
            document.body.appendChild(printFrame);
            printFrame.contentDocument.write(strukContent);
            printFrame.contentWindow.print();
            document.body.removeChild(printFrame);
        }
    </script>