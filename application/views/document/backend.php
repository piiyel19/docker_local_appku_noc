<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>My Website a Personal Portfolio Category Bootstrap Responsive Website Template | Contact :: W3layouts</title>
    <!-- web fonts -->
    <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
    <!-- //web fonts -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url()?>assets_document/assets/css/style-starter.css">
  </head>
  <body>

<section class="w3l-bootstrap-header">
  <nav class="navbar navbar-expand-lg navbar-light py-lg-3 py-2">
    <div class="container">
      <a class="navbar-brand" href="index.html"> Appku Document</a>
      <!-- if logo is image enable this   
    <a class="navbar-brand" href="#index.html">
        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
    </a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon fa fa-bars"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">How To Start</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Let's Start Project</a>
          </li>
          
        
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Sample</a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
</section>
<section class="w3l-contact-breadcrum">
  <div class="breadcrum-bg">
    <div class="container py-5">
      <p><a href="">Every Time You Do A Project, You Learn Something New</a></p>
     </div>
  </div>
</section>
<!-- contact -->
<section class="w3l-contacts-12" id="contact">
    <div class="contact-top pt-5">
        <div class="container py-md-12">
            
            <div class="row cont-main-top">
              <?php
                    // create curl resource
                    $ch = curl_init();

                    // set url
                    curl_setopt($ch, CURLOPT_URL, "example.com");

                    //return the transfer as a string
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    // $output contains the output string
                    $output = curl_exec($ch);

                    echo $output;

                    // close curl resource to free up system resources
                    curl_close($ch);     
            ?>
            </div>
        </div>
    </div>
</section>
<!-- //contact -->
 
 <!-- grids block 5 -->
 <section class="w3l-footer-29-main" id="footer">
  <div class="footer-29 text-center">
      <div class="container">
        
        <div class="main-social-footer-29">
                    
          <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
          <a href="#twitter" class="twitter"><span class="fa fa-twitter"></span></a>
          <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
          <a href="#google-plus" class="google-plus"><span class="fa fa-google-plus"></span></a>
          <a href="#linkedin" class="linkedin"><span class="fa fa-linkedin"></span></a>
      </div>
          <div class="bottom-copies text-center">
              <p class="copy-footer-29">© 2020 My Website. All rights reserved | Designed by <a href="https://w3layouts.com">W3layouts</a></p>
               
          </div>
      </div>
  </div>
   <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
              <span class="fa fa-angle-up"></span>
                 </button>
                 <script>
                     // When the user scrolls down 20px from the top of the document, show the button
                     window.onscroll = function () {
                         scrollFunction()
                     };
              
                     function scrollFunction() {
                         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                             document.getElementById("movetop").style.display = "block";
                         } else {
                             document.getElementById("movetop").style.display = "none";
                         }
                     }
              
                     // When the user clicks on the button, scroll to the top of the document
                     function topFunction() {
                         document.body.scrollTop = 0;
                         document.documentElement.scrollTop = 0;
                     }
                 </script>
                 <!-- /move top -->
</section>
<!-- // grids block 5 -->
<script src="<?= base_url()?>assets_document/assets/js/jquery-3.3.1.min.js"></script>
<!-- //footer-28 block -->
</section>

<script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>

<!-- Smooth scrolling -->



</body>

</html>
<!-- // grids block 5 -->


