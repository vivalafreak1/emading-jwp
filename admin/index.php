<?php
include("template/header.php");
include("config_query.php");
$db = new database();
$data_article = $db->show_data();
?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manajemen /</span> Artikel</h4>

  <!-- Responsive Table -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <div class="row">
          <div class="col-lg-6">
            <h5>Daftar Artikel</h5>
          </div>
          <div class="col-lg-6">
            <div class="float-end">
              <a href="tambah_data.php" class="btn btn-primary">
                <i class="bx bx-plus"></i>
                Tambah Data
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr class="text-nowrap">
              <th class="text-center bg-primary text-white">No</th>
              <th class="text-center bg-primary text-white">Gambar Header</th>
              <th class="text-center bg-primary text-white">Judul Artikel</th>
              <th class="text-center bg-primary text-white">Status Terbit</th>
              <th class="text-center bg-primary text-white">Tanggal Update</th>
              <th class="text-center bg-primary text-white">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($data_article == '0') {
              echo '<tr><td>Data Tidak Tersedia!</td></tr>';
            } else {
              $number = 1;
              foreach ($data_article as $row) {
                ?>
                <tr>
                  <th>
                    <?= $number++; ?>
                  </th>
                  <td>
                    <?= $row['imageurl']; ?>
                  </td>
                  <td>
                    <?= $row['title']; ?>
                  </td>
                  <td>
                    <?= $row['ispublished']; ?>
                  </td>
                  <td>
                    <?= $row['updated_at']; ?>
                  </td>
                  <td>
                    <a href="edit.php" class="btn btn-sm btn-warning">Ubah</a>
                    <a href="delete.php" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php
              }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<!-- / Content -->
<?php
include("template/footer.php");
?>