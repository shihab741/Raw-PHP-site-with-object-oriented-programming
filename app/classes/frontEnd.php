<?php

/**
 *
 * This class is for showing frontend contents.
 *
 */
namespace App\classes;

class frontEnd extends Database
{
	
	function __construct()
	{
		parent::__construct();
	}

	function menuItems()
	{
		$sql = "SELECT article_id, article_title_for_menu, article_slug, is_parent FROM article WHERE publication_status=1 AND is_parent=1 ORDER BY order_no";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function subMenuItems($article_id)
	{
		$sql = "SELECT article.article_title_for_menu, article.article_slug, article.is_parent FROM article INNER JOIN relation ON article.article_id=relation.article_id WHERE relation.related_article_id='$article_id'";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getArticleBySlug($slug)
	{
		$sql = "SELECT view_count FROM article WHERE article_slug='$slug'";
		$query_result = $this->run_query_for_data($sql);

		$articleDetails = mysqli_fetch_assoc($query_result);
		$articleSlug = $slug;
		$viewCount = $articleDetails['view_count'];
		$viewCount = ++$viewCount; 

		$sql = "UPDATE article SET view_count='$viewCount' WHERE article_slug='$articleSlug'";
		$this->run_query_to_save_or_update_data($sql);	

		$sql = "SELECT * FROM article WHERE publication_status=1 AND article_slug='$slug'";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;
	}

	function getAllPublishedArticles(){
		$sql = "SELECT article_heading, article_slug, article_excerpt, image_thumb FROM article WHERE publication_status=1 AND eligible_for_random_article=1 ";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;			
	}

	function getArticlesForSlider()
	{
		$sql = "SELECT article_heading, article_slug, article_excerpt, image FROM article WHERE publication_status=1 AND show_on_slider=1";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getArticlesForHome()
	{
		$sql = "SELECT article_heading, article_slug, article_excerpt, image_thumb FROM article WHERE publication_status=1 AND show_on_home=1";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getArticlesForFooter()
	{
		$sql = "SELECT article_heading, article_slug, image_thumb FROM article WHERE publication_status=1 AND show_on_footer=1";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getMostPopularArticles()
	{
		$sql = "SELECT article_heading, article_slug, article_excerpt, image_thumb FROM article WHERE publication_status=1 AND eligible_for_random_article=1 ORDER BY view_count DESC LIMIT 5";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getRandomArticles()
	{
		$sql = "SELECT article_heading, article_slug, image_thumb FROM article WHERE publication_status=1 AND eligible_for_random_article=1 ORDER BY RAND() DESC LIMIT 4";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	function getRelatedArticlesList($article_id)
	{
		$sql = "SELECT article.article_heading, article.article_slug, article.article_excerpt, article.image_thumb FROM article INNER JOIN relation ON article.article_id=relation.article_id WHERE relation.related_article_id='$article_id'";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}
}