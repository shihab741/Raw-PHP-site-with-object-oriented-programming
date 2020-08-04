<?php
require_once '../vendor/autoload.php';
use App\classes\Login;
use App\classes\Article;


    session_start();

    if($_SESSION['admin_id'] == NULL){
      header('Location: ../admin');
    }

    if(isset($_GET['logout'])){
      $login = new Login;
      $login->admin_logout();
    }

    $header_title = 'Add new article';
 
    $article = new Article();
    $query_result = $article->articleListForParentSelection();

    $message = '';
    if(isset($_POST['btn'])){
        $data = array();
        $data = $_POST;
        $fileData = array();
        $fileData = $_FILES;

        $message = $article->save_article($data, $fileData);
        header('Location: dashboard.php');
    }


?>

<?php include 'includes/header.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add new article</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-body">









<form style="padding: 10px;" role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Order number</label>
        <input type="number" name="order_no" value="0" class="form-control">
        <p class="help-block">Use order number to control which article will be shown first.</p>
    </div>

    <div class="form-group">
        <label>Article title</label>
        <input type="text" name="article_title_for_titlebar" placeholder="This title will be shown on browser title bar." class="form-control">
    </div>

    <div class="form-group">
        <label>Article title for menu</label>
        <input type="text" name="article_title_for_menu" placeholder="This title will be shown on website menu." class="form-control">
    </div>

    <div class="form-group">
        <label>Article slug</label>
        <input type="text" name="article_slug" placeholder="Use a meaningful url for SEO." class="form-control">
    </div>

    <div class="form-group">
        <label>Article heading</label>
        <input type="text" name="article_heading" placeholder="This heading will be shown on article page." class="form-control">
    </div>

    <div class="form-group">
        <label>Article excerpt</label>
        <textarea name="article_excerpt" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>Article content</label>
        <textarea name="article" class="form-control" rows="19" id="editor" ></textarea>
    </div>

    <div class="form-group">
        <label>Featured image for the article</label>
        <input type="file" name="image" multiple accept="image/*">
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="publication_status" value="1">Published
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_parent" value="1">Parent article
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_slider" value="1">Show on slider
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_home" value="1">Show on home page
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_footer" value="1">Show on footer scroll bar
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="eligible_for_random_article" value="1">Eligible for random article?
            </label>
        </div>

    </div>


    <div class="form-group">
        <label>Select parent</label>
        <p class="help-block">(Press and hold Ctrl key to select multiple parent.)</p>
        <select name="related_article_id[]" multiple class="form-control">
            <?php while ($select_article = mysqli_fetch_assoc($query_result)) :?>
                <option value="<?php echo $select_article['article_id'] ?>"><?php echo $select_article['article_title_for_menu']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Keyword</label>
        <input type="text" name="keyword" placeholder="This is a brief description of the article ontent." class="form-control">
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <textarea name="meta_description" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>Private note by the author</label>
        <textarea name="note" class="form-control" rows="3"></textarea>
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