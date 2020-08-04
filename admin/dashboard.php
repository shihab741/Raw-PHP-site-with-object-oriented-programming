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

    $header_title = 'Dashboard';
    $message = '';

    $allArticles = new Article();
    $query_result = $allArticles->show_articles_list();

    if(isset($_GET['delete'])){
        $article_id = $_GET['delete'];
        $message = $allArticles->deleteArticle($article_id);
        // header('Location: dashboard');
    }

?>
<?php include 'includes/header.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">All articles</h1>
                    <?php if(isset($_SESSION['message'])) : ?>
                        <h3 class="alert alert-success text-center"><?php echo $_SESSION['message']; ?></h3>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>

                    <?php if(!empty($message)) : ?>
                        <h3 class="alert alert-success text-center"><?php echo $message; ?></h3>
                <?php endif; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                
                                    <tr>
                                        <th>Article heading</th>
                                        <th>Order no</th>
                                        <th>Last updated</th>                                     
                                       <th>Action</th>
                                    </tr>
                               
                                </thead>
                                <tbody>
                                <?php while($article_info = mysqli_fetch_assoc($query_result)) : ?>
                                     <tr class="odd gradeX">
                                        <td>
                                            <?php if($article_info['publication_status'] == 1) : ?>
                                                <a href="<?php echo $url->getBaseUrlForAdminPanel(); ?><?php echo $article_info['article_slug']; ?>" target="_blank"><?php echo $article_info['article_heading']; ?></a>
                                            <?php else : ?>
                                                <?php echo $article_info['article_heading']; ?>
                                            <?php endif; ?>
                                            
                                        </td>
                                        <td><?php echo $article_info['order_no']; ?></td>
                                        <td><?php date_default_timezone_set("Asia/Dhaka"); echo date("d M Y, h:i:s a", $article_info['last_updated_on']); ?></td>
                                        <td class="center">
                                            <a href="editArticle.php?article_id=<?php echo $article_info['article_id']; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a href="?delete=<?php echo $article_info['article_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?');">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                 <?php endwhile; ?>
                                </tbody>

                            </table>
                            <!-- /.table-responsive -->

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