<?php 
require_once '../vendor/autoload.php';
use App\classes\Login;
use App\classes\Article;
use App\classes\simpleUrl;

    session_start();

    if($_SESSION['admin_id'] == NULL){
      header('Location: ../admin');
    }

    if(isset($_GET['logout'])){
      $login = new Login;
      $login->admin_logout();
    }
 
    $url = new simpleUrl('/oop-php/');

    $header_title = 'Edit article';

   
    $article = new Article();
    $query_result_for_article_list = $article->articleListForParentSelection();

    if(isset($_GET['article_id'])){
        $article_id = $_GET['article_id'];
        $query_result = $article->singleArticleData($article_id);
        $singleArticleData = mysqli_fetch_assoc($query_result['single_article_data']);
        // $relation_data = mysqli_fetch_assoc($query_result['single_article_relation_data']);
        $relation_data = $query_result['single_article_relation_data'];
    }


    $message = '';
    if(isset($_POST['btn'])){
        $data = array();
        $data = $_POST;
        $fileData = array();
        $fileData = $_FILES;
        $message = $article->update_article($data, $fileData);
        header('Location: dashboard.php');
    }

?>

<?php include 'includes/header.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit article</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-body">









<form style="padding: 10px;" role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="article_id" value="<?php echo $singleArticleData['article_id']; ?>">

    <div class="form-group">
        <label>Order number</label>
        <input type="number" name="order_no" class="form-control" value="<?php echo $singleArticleData['order_no']; ?>">
        <p class="help-block">Use order number to control which article will be shown first.</p>
    </div>

    <div class="form-group">
        <label>Article title</label>
        <input type="text" name="article_title_for_titlebar" placeholder="This title will be shown on browser title bar." class="form-control" value="<?php echo $singleArticleData['article_title_for_titlebar']; ?>">
    </div>

    <div class="form-group">
        <label>Article title for menu</label>
        <input type="text" name="article_title_for_menu" placeholder="This title will be shown on website menu." class="form-control" value="<?php echo $singleArticleData['article_title_for_menu']; ?>">
    </div>

    <div class="form-group">
        <label>Article slug</label>
        <input type="text" name="article_slug" placeholder="Use a meaningful url for SEO." class="form-control" value="<?php echo $singleArticleData['article_slug']; ?>">
    </div>

    <div class="form-group">
        <label>Article heading</label>
        <input type="text" name="article_heading" placeholder="This heading will be shown on article page." class="form-control" value="<?php echo $singleArticleData['article_heading']; ?>">
    </div>

    <div class="form-group">
        <label>Article excerpt</label>
        <textarea name="article_excerpt" class="form-control" rows="3"><?php echo $singleArticleData['article_excerpt']; ?></textarea>
    </div>

    <div class="form-group">
        <label>Article content</label>
        <textarea name="article" class="form-control" rows="19" id="editor"><?php echo $singleArticleData['article']; ?></textarea>
    </div>

    <div class="form-group">
        <label>Featured image for the article</label><br>
        <?php if(!empty($singleArticleData['image'])) : ?>
            <img src="<?php echo $url->getBaseUrlForAdminPanel(); ?>featured-image/<?php echo $singleArticleData['image_thumb']; ?>" style="text-align: left; width: 140px; height: 70px; display: block;">
        <?php else : ?>
            <img src="<?php echo $url->getBaseUrlForAdminPanel(); ?>demo-image/sample_thumb.png" style="text-align: left; width: 140px; height: 70px; display: block;">
        <?php endif; ?>
        <br>
        <input type="file" name="image" multiple accept="image/*">
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="publication_status" value="1" <?php echo ($singleArticleData['publication_status'] == '1') ? 'checked="checked"' : '';?>>Published
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_parent" value="1" <?php echo ($singleArticleData['is_parent'] == '1') ? 'checked="checked"' : '';?>>Parent article
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_slider" value="1" <?php echo ($singleArticleData['show_on_slider'] == '1') ? 'checked="checked"' : '';?>>Show on slider
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_home" value="1" <?php echo ($singleArticleData['show_on_home'] == '1') ? 'checked="checked"' : '';?>>Show on home page
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_footer" value="1" <?php echo ($singleArticleData['show_on_footer'] == '1') ? 'checked="checked"' : '';?>>Show on footer scroll bar
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="eligible_for_random_article" value="1" <?php echo ($singleArticleData['eligible_for_random_article'] == '1') ? 'checked="checked"' : '';?>>Eligible for random article?
            </label>
        </div>
    </div>


    <div class="form-group">
        <label>Select parent</label>
        <p class="help-block">(Press and hold Ctrl key to select multiple parent.)</p>
        <select name="related_article_id[]" multiple class="form-control">


<?php foreach ($query_result_for_article_list as $v_query_result_for_article_list) : ?>

    <option value="<?php echo $v_query_result_for_article_list['article_id']; ?>" 
    <?php foreach($relation_data as $v_relation_data) : ?>
        <?php
            if($v_relation_data['related_article_id'] == $v_query_result_for_article_list['article_id']){
                echo "selected";
            }
        ?>
    <?php endforeach; ?>
    ><?php echo $v_query_result_for_article_list['article_title_for_menu']; ?></option>
<?php endforeach; ?>



        </select>
    </div>

    <div class="form-group">
        <label>Keyword</label>
        <input type="text" name="keyword" placeholder="This is a brief description of the article ontent." class="form-control" value="<?php echo $singleArticleData['keyword']; ?>">
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <textarea name="meta_description" class="form-control" rows="3"><?php echo $singleArticleData['meta_description']; ?></textarea>
    </div>

    <div class="form-group">
        <label>Private note by the author</label>
        <textarea name="note" class="form-control" rows="3"><?php echo $singleArticleData['meta_description']; ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" name="btn" class="btn btn-primary btn-block">Save article</button>
    </div>
</form>







                               

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

 <?php include 'includes/footer.php'; ?>