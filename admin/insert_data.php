<?php
include('template/header.php');
?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="index.php">Manajemen Artikel</a> /</span>
        Tambah Data</h4>
    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Tambah Artikel Baru</h4>
                </div>
                <div class="card-body">
                    <form action="action_process.php?aksi=add" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Artikel*</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Judul Artikel" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Artikel*</label>
                                    <textarea class="form-control summernote" name="content" id="exampleFormControlTextarea1"
                                        rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status Terbit</small>
                                    <div class="form-check mt-3">
                                        <input name="ispublished" class="form-check-input" type="radio" value="publish"
                                            id="defaultRadio1" checked required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="ispublished" class="form-check-input" type="radio" value="draft"
                                            id="defaultRadio2">
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="uploadImage" class="form-label">Gambar Header*</label>
                                    <input type="file" name="imageurl" class="form-control" id="uploadImage" required />
                                    <small class="text-danger">Max Size 1Mb, ext. png, jpg, jpeg, webp</small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 float-end">
                            <a href="index.php" class="btn btn-danger">Batalkan</a>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include('template/footer.php');
?>