<?PHP
require 'admin/helpers/dbConnection.php';
require 'admin/helpers/functions.php';

# Fetch Data ... 
$sql = "select analysis.*,department.department from analysis  join department on analysis.id_dep = department.id";
$op  = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themeht.com/loptus/html/blog-grid-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jun 2020 12:21:01 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="HTML5 Template" />
<meta name="author" content="www.themeht.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Loptus - Digital Marketing Agency Responsive HTML5 Template</title>

<!-- favicon icon -->
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- inject css start -->

<!--== bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!--== animate -->
<link href="css/animate.css" rel="stylesheet" type="text/css" />

<!--== fontawesome -->
<link href="css/fontawesome-all.css" rel="stylesheet" type="text/css" />

<!--== themify -->
<link href="css/themify-icons.css" rel="stylesheet" type="text/css" />

<!--== audioplayer -->
<link href="css/audioplayer/plyr.css" rel="stylesheet" type="text/css" />

<!--== magnific-popup -->
<link href="css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

<!--== owl-carousel -->
<link href="css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />

<!--== base -->
<link href="css/base.css" rel="stylesheet" type="text/css" />

<!--== shortcodes -->
<link href="css/shortcodes.css" rel="stylesheet" type="text/css" />

<!--== default-theme -->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--== responsive -->
<link href="css/responsive.css" rel="stylesheet" type="text/css" />

<!-- inject css end -->

</head>

<body>

<!-- page wrapper start -->

<div class="page-wrapper">

<!-- preloader start -->

<div id="ht-preloader">
  <div class="loader clear-loader">
    <div class="loader-text">Loading</div>
    <div class="loader-dots"> <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</div>

<!-- preloader end -->


<!--header start-->
<?php
require 'head.php';
?>
<!--header end-->


<!--page title start-->

<section class="page-title o-hidden text-center grey-bg bg-contain animatedBackground" data-bg-img="images/pattern/05.png">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1 class="title">MEDICAL ANALYSIS</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index-2.html">Home</a>
            </li>
          
            
            <li class="breadcrumb-item active" aria-current="page">medical analysis</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="page-title-pattern"><img class="img-fluid" src="images/bg/06.png" alt=""></div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--blog start-->

<section>
  
<?php

while ($data = mysqli_fetch_assoc($op)) {

?>
 
    <!-- 111111111111111111111111111 -->
    
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-4">
        <div class="post">
        <div class="post-image">
    <!-- <div class="card "> -->
  <img src="admin/analysis/uploads/<?php echo $data['image']; ?>" class="img-fluid h-100 w-100" alt="...">
  
  <div class="card-body">
    <h5 class="card-title"><?php echo $data['name']; ?></h5>
    <p class="card-text"><?php echo $data['requirement']; ?></p>
    <p class="card-text"><small class="text-muted">price : <?php echo $data['price']; ?></small></p>
  </div>
</div>
</div>
</div>
</div>
</div>
<?php

}

?>
 
      <!-- 2222222222222222222222222222222222222222222 -->
      
      <!-- 33333333333333333333333333333333333333333333333333333333333 -->
     
      <!-- 444444444444444444444444444444444444444444444444444444444444 -->
      
      <!-- 55555555555555555555555555555555555555 -->
      
<!-- 666666666666666666666666666666666666666666666666666666666666 -->
<!--blog end-->


<!--counter start-->

<section class="grey-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="counter style-2">
          <img class="img-center" src="images/counter/01.png" alt=""> <span class="count-number" data-to="2304" data-speed="10000">2304</span>
          <h5>Project Done</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 xs-mt-5">
        <div class="counter style-2">
          <img class="img-center" src="images/counter/02.png" alt=""> <span class="count-number" data-to="2304" data-speed="10000">2304</span>
          <h5>Success Rate</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 sm-mt-5">
        <div class="counter style-2">
          <img class="img-center" src="images/counter/03.png" alt=""> <span class="count-number" data-to="2304" data-speed="10000">2304</span>
          <h5>Awards</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 sm-mt-5">
        <div class="counter style-2">
          <img class="img-center" src="images/counter/04.png" alt=""> <span class="count-number" data-to="2304" data-speed="10000">2304</span>
          <h5>Happy Client</h5>
        </div>
      </div>
    </div>
  </div>
</section>

<!--counter end-->


<!--client logo start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ht-clients d-flex flex-wrap align-items-center text-center">
          <div class="clients-logo">
            <img class="img-center" src="images/client/07.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/08.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/09.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/10.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/11.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/12.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/12.png" alt="">
          </div>
          <div class="clients-logo">
            <img class="img-center" src="images/client/12.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--client logo end-->

</div>

<!--body content end--> 


<!--footer start-->

<?php
require 'foot.php'
?>

<!--footer end-->


</div>

<!-- page wrapper end -->


<!--back-to-top start-->

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-upload"></i></a></div>

<!--back-to-top end-->

 
<!-- inject js start -->

<!--== jquery -->
<script src="js/jquery.min.js"></script>

<!--== popper -->
<script src="js/popper.min.js"></script>

<!--== bootstrap -->
<script src="js/bootstrap.min.js"></script>

<!--== appear -->
<script src="js/jquery.appear.js"></script> 

<!--== modernizr -->
<script src="js/modernizr.js"></script> 

<!--== audioplayer -->
<script src="js/audioplayer/plyr.min.js"></script>

<!--== magnific-popup -->
<script src="js/magnific-popup/jquery.magnific-popup.min.js"></script> 

<!--== owl-carousel -->
<script src="js/owl-carousel/owl.carousel.min.js"></script> 

<!--== counter -->
<script src="js/counter/counter.js"></script> 

<!--== countdown -->
<script src="js/countdown/jquery.countdown.min.js"></script> 

<!--== isotope -->
<script src="js/isotope/isotope.pkgd.min.js"></script> 

<!--== mouse-parallax -->
<script src="js/mouse-parallax/tweenmax.min.js"></script>
<script src="js/mouse-parallax/jquery-parallax.js"></script> 

<!--== contact-form -->
<script src="js/contact-form/contact-form.js"></script>

<!--== wow -->
<script src="js/wow.min.js"></script>

<!--== theme-script -->
<script src="js/theme-script.js"></script>

<!-- inject js end -->

</body>


<!-- Mirrored from themeht.com/loptus/html/blog-grid-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jun 2020 12:21:01 GMT -->
</html>