<!-- This page and other pages of the folder are for showing contents on frontend. -->
<?php include 'views/includes/header.php'; ?>



<!-- content -->
<div class="container">



<div class="content-top">
	
		
	
			<div class="single">
				<div class="row">
				<div class="col-md-9">

		<!-- banner -->
		<div class="banner">		
			<div class="header-slider">
				<div class="slider">
					<div class="callbacks_container">
					  	<ul class="rslides" id="slider">
		<!-- Articles seleted as hot or featured goes here -->							
						<?php foreach($articlesForSlider as $v_articlesForSlider) : ?>
							<li>
								<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articlesForSlider['article_slug']; ?>">
								<?php if(!empty($v_articlesForSlider['image'])) : ?>
								<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_articlesForSlider['image']; ?>" class="img-responsive oop-slider" alt="<?php echo $v_articlesForSlider['article_heading']; ?> photo">
								<?php else : ?>
									<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample.png">
								<?php endif; ?>
									<div class="caption">
										<h3><?php echo $v_articlesForSlider['article_heading']; ?></h3>
										<p><?php echo $v_articlesForSlider['article_excerpt']; ?></p>
									</div>
								</a>
							</li>
						<?php endforeach; ?>



						</ul>
			  		</div>
				 </div>
			</div>
		</div>
		<!-- banner -->	
		<!-- nam-matis -->
		<div class="nam-matis">
			<div class="nam-matis-top">
<!-- latest articles or articles selected to show on home page here -->
					<?php foreach($articlesForHome as $v_articlesForHome) : ?>
						<div class="col-md-4 nam-matis-1">
							<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articlesForHome['article_slug'] ?>">
							
							<?php if(!empty($v_articlesForHome['image_thumb'])) : ?>
								<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_articlesForHome['image_thumb'] ?>" class="img-responsive" alt="<?php echo $v_articlesForHome['article_heading']; ?> photo">
							<?php else : ?>
								<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="#">
							
							<?php endif; ?>
							
							</a>
							<h3><a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articlesForHome['article_slug'] ?>"><?php echo $v_articlesForHome['article_heading'] ?></a></h3>
							<p><?php echo $v_articlesForHome['article_excerpt'] ?></p>
							<a class="btn btn-default" href="<?php echo $url->getBaseurl(); ?><?php echo $v_articlesForHome['article_slug'] ?>">Read more...</a>
						</div>
					<?php endforeach; ?>


							<div class="clearfix"> </div>
				</div>

		</div>
		<!-- nam-matis -->	

				</div>


<?php include 'includes/sidebar.php'; ?>


<?php include 'includes/footer.php'; ?>