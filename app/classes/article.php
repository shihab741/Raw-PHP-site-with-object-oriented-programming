<?php

/**
 *
 * This class handls backend of the CMS.
 *
 */

namespace App\classes;


class Article extends Database
{
	public function __construct(){
		parent::__construct();
	}

	private function uploadImage($fileData){
		$image_name = $fileData['image']['name'];
		$directory = '../featured-image/';
		$image_url = $directory.$image_name;
		$image_type = pathinfo($image_name, PATHINFO_EXTENSION);
		$image_name_without_extension = rtrim($image_name, '.'.$image_type);

		$image_size = $fileData['image']['size'];
		$check = getimagesize($fileData['image']['tmp_name']);


		if($check == FALSE){
			die('Your file is not an image file.');
		}
		else{
			if(file_exists($image_url)){
				die('File already exists.');
			}
			else{
				if($image_size > 5000000){
					die('File is larger than allowed size.');
				}
				else{
					if($image_type != "jpg" && $image_type != 'png' && $image_type != 'jpeg'){
						die('Only jpg and png types are allowed.');
					}
					else{
						// Following line uploades featured image.
						move_uploaded_file($_FILES['image']['tmp_name'], $image_url);

						//Thumb
			$thumb_width = 300;
			$thumb_height = 150;

            $image_thumb = $directory.$image_name_without_extension.'-thumb.'.$image_type;
            list($width,$height) = getimagesize($image_url);
            $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
            switch($image_type){
                case 'jpg':
                    $source = imagecreatefromjpeg($image_url);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($image_url);
                    break;

                case 'png':
                    $source = imagecreatefrompng($image_url);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($image_url);
                    break;
                default:
                    $source = imagecreatefromjpeg($image_url);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($image_type){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$image_thumb,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$image_thumb,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$image_thumb,100);
                    break;
                default:
                    imagejpeg($thumb_create,$image_thumb,100);
            }


						//-Thumb

            		$uploadedImageData['image'] = $image_name;
            		$uploadedImageData['image_thumb'] = $image_name_without_extension.'-thumb.'.$image_type;;
            		return $uploadedImageData;
					
					}
				}
			}

		}

	}

	public function save_article($data, $fileData)
	{
		
		//Image upload code starts
		$image_name = $fileData['image']['name'];
		$image_thumb = '';
		if(!empty($image_name)){
			$uploadedImageData = $this->uploadImage($fileData);
			$image_name = $uploadedImageData['image'];
			$image_thumb = $uploadedImageData['image_thumb'];
		}
		//-/Image upload code ends


		// Checks publication status value
		if (!empty($data['publication_status'])){
			$publication_status = $data['publication_status'];
		}
		else{
			$publication_status = 0;
		}

		//Checks whether selected as parent
		if (!empty($data['is_parent'])){
			$is_parent = $data['is_parent'];
		}
		else{
			$is_parent = 0;
		}

		//Checks whether slelected for slider
		if (!empty($data['show_on_slider'])){
			$show_on_slider = $data['show_on_slider'];
		}
		else{
			$show_on_slider = 0;
		}

		//Checks whether selected to show on home page
		if (!empty($data['show_on_home'])){
			$show_on_home = $data['show_on_home'];
		}
		else{
			$show_on_home = 0;
		}

		//Checks whether selected to show on footer scroll bar
		if (!empty($data['show_on_footer'])){
			$show_on_footer = $data['show_on_footer'];
		}
		else{
			$show_on_footer = 0;
		}

		//Checks whether eligible for random article list

		if(!empty($data['eligible_for_random_article'])){
			$eligible_for_random_article = $data['eligible_for_random_article'];
		}
		else{
			$eligible_for_random_article = 0;
		}

		$publication_date = time();
		$last_updated_on = time();

		$sql = "INSERT INTO article(order_no, article_title_for_titlebar, article_title_for_menu, article_slug, article_heading, article_excerpt, article, image, image_thumb, publication_status, is_parent, show_on_slider, show_on_home, show_on_footer, eligible_for_random_article, keyword, meta_description, note, publication_date, last_updated_on)VALUES('$data[order_no]', '$data[article_title_for_titlebar]', '$data[article_title_for_menu]', '$data[article_slug]', '$data[article_heading]', '$data[article_excerpt]', '$data[article]', '$image_name', '$image_thumb', '$publication_status', '$is_parent', '$show_on_slider', '$show_on_home ', '$show_on_footer', $eligible_for_random_article, '$data[keyword]', '$data[meta_description]', '$data[note]', '$publication_date', '$last_updated_on' )";

		$this->run_query_to_save_or_update_data($sql);
		$article_id =  $this->connection->insert_id;

		if(!empty($data['related_article_id'])){
			$related_article_id = $data['related_article_id'];

			foreach ($related_article_id as $v_related_article_id) {
				$sql = "INSERT INTO relation(article_id, related_article_id)VALUES('$article_id', '$v_related_article_id')";
				$this->run_query_to_save_or_update_data($sql);
			}
		}
		
		$_SESSION['message'] = 'Article saved successfully!';
		header('Location: dashboard.php');

	}

	public function show_articles_list()
	{
		$sql = "SELECT * FROM article";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;
	}

	public function singleArticleData($article_id)
	{
		$sql = "SELECT * FROM article where article_id='$article_id'";
		$query_result['single_article_data'] = $this->run_query_for_data($sql);

		$sql = "SELECT * FROM relation where article_id='$article_id'";
		$query_result['single_article_relation_data'] = $this->run_query_for_data($sql);

		return $query_result;
	}

	public function articleListForParentSelection()
	{
		$sql = "SELECT article_id, article_title_for_menu FROM article ORDER BY article_title_for_menu ASC";
		$query_result = $this->run_query_for_data($sql);
		return $query_result;		
	}

	public function update_article($data, $fileData)
	{


		$article_id = $data['article_id'];

		//Gets old image name
		$sql = "SELECT image, image_thumb FROM article WHERE article_id='$article_id'";
		$query_result = $this->run_query_for_data($sql);
		$checkingImageData = mysqli_fetch_assoc($query_result);
		$image_name = $checkingImageData['image'];
		$image_thumb = $checkingImageData['image_thumb'];
		//- Gets old image name



		//Image upload code starts
		if(!empty($fileData['image']['name'])){
			if(empty($checkingImageData['image'])){
				$uploadedImageData = $this->uploadImage($fileData);
				$image_name = $uploadedImageData['image'];
				$image_thumb = $uploadedImageData['image_thumb'];				
			}
			else{
				unlink('../featured-image/'.$checkingImageData['image']);
				unlink('../featured-image/'.$checkingImageData['image_thumb']);

				$uploadedImageData = $this->uploadImage($fileData);
				$image_name = $uploadedImageData['image'];
				$image_thumb = $uploadedImageData['image_thumb'];	
			}
		}
		//-/Image upload code ends



		// Checks publication status value
		if (!empty($data['publication_status'])){
			$publication_status = $data['publication_status'];
		}
		else{
			$publication_status = 0;
		}

		//Checks whether selected as parent
		if (!empty($data['is_parent'])){
			$is_parent = $data['is_parent'];
		}
		else{
			$is_parent = 0;
		}

		//Checks whether slelected for slider
		if (!empty($data['show_on_slider'])){
			$show_on_slider = $data['show_on_slider'];
		}
		else{
			$show_on_slider = 0;
		}

		//Checks whether selected to show on home page
		if (!empty($data['show_on_home'])){
			$show_on_home = $data['show_on_home'];
		}
		else{
			$show_on_home = 0;
		}

		//Checks whether selected to show on footer scroll bar
		if (!empty($data['show_on_footer'])){
			$show_on_footer = $data['show_on_footer'];
		}
		else{
			$show_on_footer = 0;
		}

		//Checks whether eligible for random article list

		if(!empty($data['eligible_for_random_article'])){
			$eligible_for_random_article = $data['eligible_for_random_article'];
		}
		else{
			$eligible_for_random_article = 0;
		}

		$last_updated_on = time();

		$sql = "UPDATE article SET order_no='$data[order_no]', article_title_for_titlebar='$data[article_title_for_titlebar]', article_title_for_menu='$data[article_title_for_menu]', article_slug='$data[article_slug]', article_heading='$data[article_heading]', article_excerpt='$data[article_excerpt]' , article='$data[article]', image='$image_name', image_thumb='$image_thumb', publication_status='$publication_status', is_parent='$is_parent', show_on_slider='$show_on_slider', show_on_home='$show_on_home', show_on_footer='$show_on_footer', eligible_for_random_article='$eligible_for_random_article', keyword='$data[keyword]', meta_description='$data[meta_description]', note='$data[note]', last_updated_on='$last_updated_on' WHERE article_id='$article_id'";

		$this->run_query_to_save_or_update_data($sql);

		$sql = "DELETE FROM relation WHERE article_id='$article_id'";
		$this->run_query_to_save_or_update_data($sql);

		if(!empty($data['related_article_id'])){
			$related_article_id = $data['related_article_id'];

			foreach ($related_article_id as $v_related_article_id) {
				$sql = "INSERT INTO relation(article_id, related_article_id)VALUES('$article_id', '$v_related_article_id')";
				$this->run_query_to_save_or_update_data($sql);
			}
		}
		$_SESSION['message'] = 'Article edited successfully!';
	}

	public function deleteArticle($article_id)
	{

		//Gets old image name
		$sql = "SELECT image, image_thumb FROM article WHERE article_id='$article_id'";
		$query_result = $this->run_query_for_data($sql);
		$checkingImageData = mysqli_fetch_assoc($query_result);
		//- Gets old image name

		//Image deletion code starts
			if(!empty($checkingImageData['image'])){
				unlink('../featured-image/'.$checkingImageData['image']);
				unlink('../featured-image/'.$checkingImageData['image_thumb']);			
			}
		//-/Image deletion code ends

		$sql = "DELETE FROM article WHERE article_id='$article_id'";
		$this->run_query_to_save_or_update_data($sql);		

		$sql = "DELETE FROM relation WHERE article_id='$article_id'";
		$this->run_query_to_save_or_update_data($sql);	

		$message = 'Article deleted successfully!';
		return $message;
	}
}