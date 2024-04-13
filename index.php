<?php require_once 'inc/connection.php'; ?>
<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/function.php'; ?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
        <h4>Best Offer</h4>
        <h2>New Arrivals On Sale</h2>
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
        <h4>Flash Deals</h4>
        <h2>Get your best products</h2>
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
        <h4>Last Minute</h4>
        <h2>Grab last minute deals</h2>
      </div>
    </div>
  </div>
</div>
<!-- Banner Ends Here -->
<?php

if(isset($_GET['page'])){
  $page =abs($_GET['page']);
}
else{
  $page = 1 ; 
}

$limit=2;
$offset = ($page - 1)*$limit;


    //numberOfPages
$query = "select count('id') as total from posts";
$runQuery = mysqli_query($conn , $query);
$result = mysqli_fetch_assoc($runQuery);
$total = $result['total'];
$numberOfPages =ceil( $total / $limit);

if( $page > $numberOfPages)
{
header("location:{$_SERVER['PHP_SELF']}?page=$numberOfPages");
}elseif($page < 1 ){
header("location:{$_SERVER['PHP_SELF']}?page=1");
}

$query = "select id,  title , substring(body , 1,53) as body , image , created_at from posts order By id limit $limit offset $offset";
$runQuery = mysqli_query($conn, $query);
if (mysqli_num_rows($runQuery)) {

  $posts = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
} else {
  $msg = "no posts founded";
}
?>



<?php
if (!empty($posts)) :
?>
  <div class="latest-products">

    <div class="container">
      <?php
      require_once './inc/succes.php';
      require_once './inc/error.php';
      ?>

      <div class="row">

        <div class="col-md-12">

          <div class="section-heading">

            <h2>Latest Posts</h2>

            <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
          </div>

        </div>

        <?php
        foreach ($posts as $post) :
        ?>

          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="upload/<?php echo $post['image'] ?>" alt=""></a>
              <div class="down-content">
                <a href="#">
                  <h4><?php echo $post['title'] ?></h4>
                </a>
                <h6><?php echo $post['created_at'] ?></h6>
                <p> <?php echo $post['body'] . "...." ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <span>Reviews (24)</span>
                  </ul>

                </div>
                <div class="d-flex justify-content-center">
                  <a href="viewPost.php?id=<?php echo $post['id']  ?>" class="btn btn-danger "> view</a>
                </div>

              </div>
            </div>
          </div>

        <?php endforeach; ?>


      </div>


    </div>
  </div>

<?php
else : echo $msg;
endif;
?>
<div class="d-flex justify-content-center align-items-center mt-5">

  <nav aria-label="Page navigation example ">
    <ul class="pagination">
      <li class="page-item <?php if($page == 1) echo "disabled " ?>">
        <a class="page-link text-danger " href="<?php echo $_SERVER['PHP_SELF']."?page=".$page-1  ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item "><a class="page-link text-danger" ><?php  echo $page ?></a></li>
      
      <li class="page-item <?php if($page == $numberOfPages) echo "disabled " ?>">
        <a class="page-link text-danger" href="<?php echo $_SERVER['PHP_SELF']."?page=".$page+1  ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>

<?php require_once 'inc/footer.php'; ?>