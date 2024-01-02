<?php
include('template/header.php');
include('admin/config_query.php');
$db = new database();
$data_article = $db->show_data_landing();
?>
<section class="section">
	<div class="container">

		<div class="row mb-4">
			<div class="col-sm-6">
				<h2 class="posts-entry-title">e-Mading JeWePe</h2>
			</div>
		</div>

		<div class="row">
			<?php
			foreach ($data_article as $row) {

				?>
				<div class="col-lg-4 mb-4">
					<div class="post-entry-alt">
						<a href="detail.php?id=<?= $row['id_article']; ?>" class="img-link">
						<img src="files/<?= $row['imageurl']; ?>" alt="Image" class="img-fluid" 
						style="max-height: 300px;"></a>
						<div class="excerpt">

							<h2><a href="detail.php?id=<?= $row['id_article']; ?>">
									<?= $row['title']; ?>
								</a></h2>
							<div class="post-meta align-items-center text-left clearfix">
								<figure class="author-figure mb-0 me-3 float-start"><img
										src="assets/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
								<span class="d-inline-block mt-1">By <a href="#">
										<?= $row['name']; ?>
									</a></span>
								<span>&nbsp;-&nbsp;
									<?php
									if ($row['updated_at'] == '') {
										echo date('d M Y H:i:s', strtotime($row['created_at']));
									} else {
										echo date('d M Y H:i:s', strtotime($row['updated_at']));
									}
									?>
								</span>
							</div>

							<?= $row['content']; ?>
							<p>
								<a href="detail.php?id=<?= $row['id_article']; ?>" class="read-more">Selengkapnya</a>
							</p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php
include('template/footer.php')
	?>