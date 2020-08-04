<?php

/**
 *
 * Code for handling frontend contents.
 *
 */

require_once 'vendor/autoload.php';

use App\classes\simpleUrl;
$url = new simpleUrl('/oop-php/');

use App\classes\frontEnd;
$frontEnd = new frontEnd();



$menuItems = $frontEnd->menuItems();
$articlesForFooter = $frontEnd->getArticlesForFooter();
$mostPopularArticles = $frontEnd->getMostPopularArticles();



	if(!$url->segment(1))
	{
		$page = 'home';
	}
	else
	{
		$page = $url->segment(1);
	}


if(($page == 'home') || ($page == '?i=1'))
{
	$articlesForSlider = $frontEnd->getArticlesForSlider();
	$articlesForHome = $frontEnd->getArticlesForHome();
	include 'views/home.php';
}
elseif($page == 'archive')
{
	$articleDetailsForArchivePage = $frontEnd->getAllPublishedArticles();
	include 'views/article-list.php';
}
else
{
	$queryResultForArticleDetailsBySlug = $frontEnd->getArticleBySlug($page);

	if($queryResultForArticleDetailsBySlug->num_rows != 0){
		$articleDetailsBySlug = mysqli_fetch_assoc($queryResultForArticleDetailsBySlug);
		$article_id = $articleDetailsBySlug['article_id'];
		$queryResultForRelatedArticles = $frontEnd->getRelatedArticlesList($article_id);
		$randomArticles = $frontEnd->getRandomArticles();
		include 'views/single-article-page.php';		
	}
	else
	{
		include 'views/404.php';
	}

}
