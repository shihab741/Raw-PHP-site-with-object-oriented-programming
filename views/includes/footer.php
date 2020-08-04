<!-- footer section starts here -->
		<div class="fle-xsel">
			<ul id="flexiselDemo3">
<!-- Selected articles with thumbnail and title at the bottom of the page. -->
			<?php foreach($articlesForFooter as $v_articlesForFooter) : ?>
				<li>
					<a href="<?php echo $url->getBaseurl(); ?><?php echo $v_articlesForFooter['article_slug']; ?>">
						<div class="banner-1">	

						<?php if(!empty($v_articlesForFooter['image_thumb'])) : ?>
						<img src="<?php echo $url->getBaseurl(); ?>featured-image/<?php echo $v_articlesForFooter['image_thumb']; ?>" class="img-responsive" alt="<?php echo $v_articlesForFooter['article_heading']; ?> photo">
						<?php else : ?>

							<img src="<?php echo $url->getBaseurl(); ?>demo-image/sample_thumb.png" class="img-responsive" alt="">
						<?php endif; ?>					
								<div class="caption">
									<p><?php echo $v_articlesForFooter['article_heading']; ?></p>
								</div>							
						</div>
					</a>
				</li>
			<?php endforeach; ?>			
			</ul>
							
							 <script type="text/javascript">
								$(window).load(function() {
									
									$("#flexiselDemo3").flexisel({
										visibleItems: 5,
										animationSpeed: 1000,
										autoPlay: true,
										autoPlaySpeed: 3000,    		
										pauseOnHover: true,
										enableResponsiveBreakpoints: true,
										responsiveBreakpoints: { 
											portrait: { 
												changePoint:480,
												visibleItems: 2
											}, 
											landscape: { 
												changePoint:640,
												visibleItems: 3
											},
											tablet: { 
												changePoint:768,
												visibleItems: 3
											}
										}
									});
									
								});
								</script>
								<script type="text/javascript" src="<?php echo $url->getBaseurl(); ?>js/jquery.flexisel.js"></script>
					<div class="clearfix"> </div>
		</div>
		<div class="footer">
			
			
			<div class="clearfix"> </div>
			<div class="copyright">
				<p>Developed by: <a href="http://shihab.fromreadingtable.com" target="_blank" title="Click here to visit Shihab's personal site"> Shihab Uddin Ahmed </a></p>
			</div>
		</div>
	</div>
	</div>





</body>
</html>