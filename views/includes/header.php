<!DOCTYPE HTML>
<html>
<head>
<title><?php if(isset($articleDetailsBySlug['article_title_for_titlebar'])){echo $articleDetailsBySlug['article_title_for_titlebar'].' |';} ?> Shihab's demo site using object oriented php</title>
<link href="<?php echo $url->getBaseurl(); ?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $url->getBaseurl(); ?>css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<!-- Favicon image -->
<link rel="icon" type="image/gif" href="<?php echo $url->getBaseurl(); ?>">

<!-- Code for article meta description and keywords here  -->
<meta name="description" content="<?php if(isset($articleDetailsBySlug['meta_description'])){echo $articleDetailsBySlug['meta_description'];} ?>">
<meta name="keywords" content="<?php if(isset($articleDetailsBySlug['keyword'])){echo $articleDetailsBySlug['keyword'];} ?>" />


<!-- files for responsive menu starts -->
  <link rel="stylesheet" type="text/css" href="<?php echo $url->getBaseurl(); ?>shihab-assets/dropdowns.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $url->getBaseurl(); ?>shihab-assets/dropdowns-skin-discrete.css">
<!-- files for resposive menu ends -->


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
<script src="<?php echo $url->getBaseurl(); ?>js/jquery.min.js"></script>
<script src="<?php echo $url->getBaseurl(); ?>js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  
  </script>
  
</head>
<body>
<!-- header -->
  <div class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3" style="padding-left: 0px; margin-left: 0px;">
          <a href="<?php echo $url->getBaseurl(); ?>"><img src="<?php echo $url->getBaseurl(); ?>demo-image/logo.png" class="img-responsive" alt=""></a>
        </div>

        <div class="col-md-9">        
            <h1 class="text-center">Advertisement</h1>        
        </div>
        
      </div>
<br>


<!-- responsive menu starts -->
<div class="dropdowns">
  
<a class="toggleMenu" href="<?php echo $url->getBaseurl(); ?>#">Menu</a>
<ul class="nav">
  <li><a href="<?php echo $url->getBaseurl(); ?>">Home</a></li>
  <?php foreach($menuItems as $v_menuItems) : ?>


          <li><a href="<?php echo $url->getBaseurl(); ?><?php echo $v_menuItems['article_slug']; ?>"><?php echo $v_menuItems['article_title_for_menu']; ?></a>

            <?php $subMenuItems = $frontEnd->subMenuItems($v_menuItems['article_id']); if($subMenuItems->num_rows != 0) : ?>
              <ul>
                <?php foreach($subMenuItems as $v_sumMenuItems) : ?>
                  <li><a href="<?php echo $url->getBaseurl(); ?><?php echo $v_sumMenuItems['article_slug']; ?>"><?php echo $v_sumMenuItems['article_title_for_menu']; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else : ?>
            </li>
          <?php endif; ?>



  <?php endforeach; ?>
  <li><a href="<?php echo $url->getBaseurl(); ?>archive">Archive</a></li>




</ul>
</div>


<script type="text/javascript" src="<?php echo $url->getBaseurl(); ?>shihab-assets/dropdowns.js"></script>
<script>
  $(".dropdowns").dropdowns();
</script>

<!-- responsive menu ends -->

                  
      
          <div class="clearfix"> </div>
    </div>
  </div>
<!-- header --> <!-- header ends here -->