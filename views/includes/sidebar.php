<!-- sidebar section starts here -->

	<!-- Most visited articles here -->
	<div class="col-md-3">
		<span class="popular"><h3>Popular articles</h3></span>
		<div class="blo-top">
		<?php foreach($mostPopularArticles as $v_mostPopularArticles) : ?>
			<div class="blog-grids">
				<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_mostPopularArticles['article_slug']; ?>">
					<div class="blog-grid-left">
					<?php if(!empty($v_mostPopularArticles['image_thumb'])) : ?>
					<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_mostPopularArticles['image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_mostPopularArticles['article_heading']; ?> photo">
				<?php else : ?>
						<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="<?php echo $v_mostPopularArticles['article_heading']; ?> photo">
				<?php endif; ?>
					</div>
					<div class="blog-grid-right">
						<h4><?php echo $v_mostPopularArticles['article_heading']; ?></h4>
						<p><?php echo $v_mostPopularArticles['article_excerpt']; ?></p>
					</div>
				</a>
				<div class="clearfix"> </div>
			</div>
		<?php endforeach; ?>
		</div>


</div>
	<div class="clearfix"> </div>
	</div>
</div>
<!-- sidebar section ends here -->