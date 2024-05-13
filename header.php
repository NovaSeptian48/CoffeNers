<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_userc WHERE username= '$_SESSION[username_cafeku]'");
$records = mysqli_fetch_array($query);

?>

<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-cup-hot"></i> CoffeNers</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-square"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalGantiPassword"><i class="bi bi-card-list"></i> Ganti Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal profile -->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="Your name" name="nama" required value=" <?php echo $_SESSION['username_cafeku'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukan username
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Your name" name="username" required value=" <?php echo $records['nama'] ?>">
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">
                                    Masukan Nama
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="08xxxxx" name="telepon" required value=" <?php echo $records['telepon'] ?>">
                                <label for="floatingInput">Telepon</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="ubah_profile_validate" value="12345">Simpan</button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>
<!-- end  Modal profile -->

<!-- Modal ganti pass -->
<div class="modal fade" id="ModalGantiPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value=" <?php echo $_SESSION['username_cafeku'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukan username
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordlama" required>
                                <label for="floatingInput">Password sebelumnya</label>
                                <div class="invalid-feedback">
                                    Masukan password sebelumnya
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordbaru" required>
                                <label for="floatingInput">Password baru</label>
                                <div class="invalid-feedback">
                                    Masukan password baru
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="repasswordbaru" required>
                                <label for="floatingInput">Ulangi password baru</label>
                                <div class="invalid-feedback">
                                    Ulangi password baru
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="12345">Ganti password</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end  Modal ganti pass -->