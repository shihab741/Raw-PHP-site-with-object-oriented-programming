<?php include 'views/includes/header.php'; ?>


<!-- content -->
<div class="container">



<div class="content-top">
	
		
	
			<div class="single">
				<div class="row">
				<div class="col-md-9">

		
		<!-- nam-matis -->
		
			<div class="nam-matis-top">

<span class="menu-name"><h1>Archive page for articles</h1></span>

<!-- Breadcrumb code goes here-->
	<p class="sin"><a href="#">Home</a> &raquo; <a href="#">Menu</a> &raquo; <a href="#">Article title</a></p><br>

<!-- articles under a specific menu here -->
		<?php foreach($articleDetailsForArchivePage as $v_articleDetailsForArchivePage) : ?>
						<div class="col-md-4 nam-matis-1">

							<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articleDetailsForArchivePage['article_slug']; ?>">
							<?php if(!empty($v_articleDetailsForArchivePage['image_thumb'])) : ?>
								<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_articleDetailsForArchivePage['image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_articleDetailsForArchivePage['article_heading']; ?> photo">
							<?php else : ?>
								<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="#">
							<?php endif; ?>
							</a>

							<h3><a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articleDetailsForArchivePage['article_slug']; ?>">
								<?php echo $v_articleDetailsForArchivePage['article_heading']; ?>
							</a></h3>

							<p><?php echo $v_articleDetailsForArchivePage['article_excerpt']; ?></p>

							<a class="btn btn-default" href="<?php echo $url->getBaseurl(); ?><?php echo $v_articleDetailsForArchivePage['article_slug']; ?>">Read more...</a>
						</div>

		<?php endforeach; ?>


							<div class="clearfix"> </div>
				</div>

		
		<!-- nam-matis -->	

				</div>

<?php include 'includes/sidebar.php'; ?>


<?php include 'includes/footer.php'; ?>