<?php include 'views/includes/header.php'; ?>

<div class="container">
	<div class="main">
		<div class="error-404 text-center">
				<h1>404</h1>
				<p><b>Page not found. This might be because:</b><br>
	You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
	<p><b>Please try the following options instead:</b></p>
	<ul style="list-style: none;">
		<li> Use search box to see if it's available elsewhere</li>
		<li> Try one of the links on top of the page.</li>
	</ul>
				<a class="b-home" href="<?php echo $url->getBaseurl(); ?>">Back to Home</a>
			</div>
	</div>
	<!-- 404 -->



<?php include 'includes/footer.php'; ?>