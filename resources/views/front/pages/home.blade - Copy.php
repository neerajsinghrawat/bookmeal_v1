@extends('layouts.front')

@section('content')
  <div id="mainCarousel">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <script
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
      </script>
      <script>
      var myCenter=new google.maps.LatLng(51.508742,-0.120850);
      var marker;
      function initialize()
      {
      var mapProp = {
        center:myCenter,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
      marker=new google.maps.Marker({
        position:myCenter,
       // icon:'themes/assets/images/nepali-momo.png',
        animation:google.maps.Animation.BOUNCE
        });

      marker.setMap(map);

      // Info open
      var infowindow = new google.maps.InfoWindow({
        content:"Hello World!"
        });

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
      </script>
      <div id="googleMap" style="height:450px;"></div>
        <div class="container">
        <div class="carousel-caption">
          <a class="btn btn-lg btn-default" href="#" role="button" style="font-size:2em">Order Online Now &raquo;</a>
        </div>
        </div>
      </div>
      </div>
    </div><!-- /.carousel -->
  </div>

  <div class="mainTitle">
  <div class="container">
  <h1>Bootstrappage Restaurant</h1>
  <p>
  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 
  </p>
  </div>
  </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
      <!-- Three columns of text below the carousel -->
      <div class="row">
        
        <?php
        
        if (isset($category_list[0]) && !empty($category_list)) {
          
         $index = 0;
         foreach ($category_list as $category){
         $index++;
         ?>
        <div class="col-lg-4">
          
        <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav"> 
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown"><?php echo $category['name']; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                            <?php     foreach ($category->children as $category_sub){
         ?>
                    <li><a href="{{ URL::to('product/'.$category_sub['slug']) }}">{{ $category_sub['name'] }}</a></li>
                    <?php }?>
                  </ul>
                </li>
              </ul>
            </div>
        </div>
        <?php } }?>
      </div><!-- /.row -->
  </div>
  

  
  
  <div class="introSection">
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="cntr">We are launching complete online food order system for restaurent and takeaway Only at the rate <br>&pound;999 </h1>
      </div>
    </div>
    </div>
  </div>
  
  
  
  
  
  
  
  
   <div class="container marketing">
    <h2 class="itemsTitle">Breakfast</h2>
  <div id="myCarousel1" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner">
        <div class="item active">
         <div class="row">
        <div class="col-lg-4">
          <img src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/burger.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
         <div class="row">
        <div class="col-lg-4">
          <img src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/burger.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
          <div class="row">
        <div class="col-lg-4">
          <img  src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/burger.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel1" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel1" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
  </div>
  
  <div class="container marketing">
    <h2 class="itemsTitle">Lunch</h2>
  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner">
        <div class="item active">
         <div class="row">
        <div class="col-lg-4">
           <img src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
         <img src="themes/assets/images/chicken.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks_lussy.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
         <div class="row">
        <div class="col-lg-4">
          <img src="themes/assets/images/chicken_fry.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/fish-and-chips.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
          <div class="row">
        <div class="col-lg-4">
          <img  src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/burger.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel2" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel2" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
  </div>
  
  <div class="container marketing">
    <h2 class="itemsTitle">Dinner</h2>
  <div id="myCarousel3" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner">
        <div class="item active">
         <div class="row">
        <div class="col-lg-4">
          <img src="themes/assets/images/chicken_fry.png" alt="Generic placeholder image">
          <h4>Chicken</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/rice.png" alt="Generic placeholder image">
          <h4>Rice</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
         <div class="row">
        <div class="col-lg-4">
          <img src="themes/assets/images/courinder.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/burger.png" alt="Generic placeholder image">
          <h4>Meal</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
     
        </div>
        <div class="item">
          <div class="row">
        <div class="col-lg-4">
          <img  src="themes/assets/images/salate.png" alt="Generic placeholder image">
          <h4>Salates</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/chicken_fry.png" alt="Generic placeholder image">
          <h4>Chicken</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img  src="themes/assets/images/drinks.png" alt="Generic placeholder image">
          <h4>Drink</h4>
          <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel3" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel3" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
  </div>
  

  <div class="highlightSection">
  <div class="container">
  <div class="row">
    <div class="col-lg-4">
    <div class="media">
      <a href="menu/"><img src="themes/assets/images/nepali-momo.png" alt="nepali-momo"> </a>
      <h3 class="media-heading text-primary-theme">NEPALESE LAMB MOMO</h3>
      <p>Steamed dumplings filled with slightly spiced minced meat served with special sauce.</p>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="media"><a href="menu/"><img src="themes/assets/images/gorkha-special-chicken.png" alt="GURKHA SPECIAL CHICKEN"> </a>            
    <h3 class="media-heading text-danger-theme">GURKHA SPECIAL CHICKEN</h3>
    <p>Boneless chicken marinated in mustard, smoked chilli, herbs and spices slowly cooked in tandoor. </p>
    
    </div>
    </div>
    <div class="col-lg-4">
    <div class="media">
    <a href="menu/"><img src="themes/assets/images/lam-tikka.png" alt="Lam Tikka"> </a>
    <h3 class="media-heading">LAMB TIKKA SPECIAL</h3>
    <p>Tender pieces of lamb mixed with our own spices and gently cooked in clay oven. </p>
    </div>
    </div>
  </div>
  </div>
  </div>
        

  
  <div class="introSection">
    <div class="container">
    <div class="row">
    <div class="col-lg-5">
    <h3>Welcome to restaurent</h3>
    <p>
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 
    text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br><br>
    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </p>
    </div>
    
    <div class="col-lg-4">
    <h3>Welcome to restaurent</h3>
    <p>
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 
    text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br><br>
    
    </p>
    
    </div>
    
    <div class="col-lg-3">
    <h3>Welcome to restaurent</h3>
    <p>
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 
    text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
    
    </p>
    
    </div>
    
    </div>
    </div>
  </div>


   <div class="container marketing">
   <div id="myCarousel4" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner">
      <div class="item active">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Fish and Chips <span class="text-muted">It's very very testy</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img src="themes/assets/images/fish-and-chips.png" alt="Fish and Chips">
        </div>
      </div>
      </div>

      
  <div class="item">
      <div class="row featurette">
        <div class="col-md-5">
          <img src="themes/assets/images/burger.png" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Oh yeah, very nice Burger. <span class="text-muted">Delicious.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
      </div>
      </div>


  <div class="item">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Try yourself <span class="text-muted">Testy</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
      <img class="img-circle" src="themes/assets/images/drinks.png" alt="Generic placeholder image">
        </div>
      </div>
      </div>
     </div>
    </div><!-- /.carousel -->   
    </div><!-- /.container -->
@endsection
