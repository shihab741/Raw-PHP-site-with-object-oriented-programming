<?php include 'views/includes/header.php'; ?>



<!-- content -->
<div class="container">


<div class="content-top">
	
		
	
			<div class="single">
				<div class="row">
				<div class="col-md-9">
					
				<div class="single-top">
				
					<h1><?php echo $articleDetailsBySlug['article_heading']; ?></h1>

			<!-- Breadcrumb code goes here-->
				<p class="sin"><a href="#">Home</a> &raquo; <a href="#">Menu</a> &raquo; <a href="#">Article title</a></p>
		
<?php if(!empty($articleDetailsBySlug['article'])) : ?>

				<?php if(!empty($articleDetailsBySlug['image'])) : ?>
					<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $articleDetailsBySlug['image']; ?>" class="img-responsive" alt="<?php echo $articleDetailsBySlug['article_heading']; ?> photo">
				<?php else : ?>
					<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample.png" class="img-responsive" alt="">
				<?php endif; ?>

					<!-- content from excerpt will go here -->
					<hr>
					<span class="excerpt"><h4><?php echo $articleDetailsBySlug['article_excerpt']; ?></h4></span>

					<!--Article content starts here -->
				<?php echo $articleDetailsBySlug['article']; ?>	

				<div class="oop-php-date">
					<p>Published on: <strong><?php date_default_timezone_set("Asia/Dhaka"); echo date("d M Y, h:i:s a", $articleDetailsBySlug['publication_date']); ?></strong></p>	
					<p>Last updated on: <strong><?php date_default_timezone_set("Asia/Dhaka"); echo date("d M Y, h:i:s a", $articleDetailsBySlug['last_updated_on']); ?></strong></p>	
				</div>
		
<?php endif; ?>



				</div>



<div class="clearfix"> </div>





	<!-- Related articles here -->
<?php if($queryResultForRelatedArticles->num_rows != 0) : ?>
		<div class="blo-top row well">
		<?php foreach($queryResultForRelatedArticles as $v_queryResultForRelatedArticles) : ?>
			<div class="blog-grids col-md-6">
				<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_queryResultForRelatedArticles['article_slug']; ?>">
					<div class="blog-grid-left">
				<?php if(!empty($v_queryResultForRelatedArticles['image_thumb'])) : ?>
					<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_queryResultForRelatedArticles['image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_queryResultForRelatedArticles['article_heading']; ?> photo">
				<?php else : ?>
						<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="<?php echo $v_queryResultForRelatedArticles['article_heading']; ?> photo">
				<?php endif; ?>
					</div>
					<div class="blog-grid-right">
						<h4><?php echo $v_queryResultForRelatedArticles['article_heading']; ?></h4>
						<p><?php echo $v_queryResultForRelatedArticles['article_excerpt']; ?></p>
					</div>
				</a>
				<div class="clearfix"> </div>
			</div>
		<?php endforeach; ?>
		</div>
<?php endif; ?>

	<div class="clearfix"> </div>
	<!-- Related article code ends. -->




<div class="single-top">
<div class="row">
						<span class="random"><h3>Random articles:</h3></span>
					<?php foreach($randomArticles as $v_getRandomArticles) : ?>
						<div class="col-md-3 nam-matis-1">

						<?php if(!empty($v_getRandomArticles['image_thumb'])) : ?>
							<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_getRandomArticles['article_slug']; ?>"><img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_getRandomArticles['image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_getRandomArticles['article_heading']; ?> photo"></a>
						<?php else : ?>

							<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_getRandomArticles['article_slug']; ?>"><img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="<?php echo $v_getRandomArticles['article_heading']; ?> photo"></a>
						<?php endif; ?>

							<h4><a href="<?php echo $url->getBaseurl(); ?><?php echo $v_getRandomArticles['article_slug']; ?>"><?php echo $v_getRandomArticles['article_heading']; ?></a></h4>
						</div>
					<?php endforeach; ?>

</div></div>

<div class="clearfix"> </div>
				</div>

			
<?php include 'includes/sidebar.php'; ?>


<?php include 'includes/footer.php'; ?>