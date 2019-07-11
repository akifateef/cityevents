
  <?php include'header.php';?>
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 300px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
 <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 400px   /* The width is the width of the web page */
       }
    </style>
</head>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<body>
<?php

if(isset($_GET['fav']))
{
$fav = $_GET['fav'];
  setcookie('fav', $fav, time() + 360000, '/');
}
?>

<div class="slideshow-container">

<div class="mySlides">

<?php 
if($event->image != '')
{
	$image = $event->image_path;
}
else {
	$image = 'download.png';
}
?>
  <img src="<?php echo base_url().'images/'.$image;?>"  style="width:100%">
 
</div>

</div>
<br>

<div style="text-align:center">
              
           
             <h5> Event Name:</h5><h4><?php echo $event->name; ?> 
             
             <br><p></p><?php echo $event->description; ?><br> </h4>
             <?php
             if(@$_COOKIE['fav']== $event->id){
               ?>
               <span class="badge badge-success">My Favorite Event</span>
               <?php
             }
             else{
             ?>
                 <form name="" id="formId" method="get">
                       <input type="hidden" name="fav" id="cook" value="<?php echo $event->id?>" />
  											<input type="submit" class="btn btn-primary"  id="add_fav" value="Add to Favorite">
                    
                    </form>
             <?php }?>
             <br>
              Location: <?php echo $event->location_name; ?><br>
             Date: <?php echo $event->date_start; ?> till <?php echo $event->date_end; ?> 
            
             <br>
             <input type="hidden" name="lat" id="lat" value="<?php echo $event->latitude; ?>"/>
             
             <input type="hidden" name="long" id="long" value="<?php echo $event->longitude; ?>"/>
             <?php 
             if($event->latitude != ''){
                  ?>
          <div id="map" style="margin-left: 1100px"></div>
            <?php }?>
             <br>
          </div>
        </div>
      



<script>

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
             
            
<br>
<br>
<br>
<br>
<br>
            
  <?php include'footer.php';?>
  <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var lat = $('#lat').val();
  var long = $('#long').val();
  var uluru = {lat: parseFloat(lat), lng: parseFloat(long)};
  console.log(uluru);
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0UsNMtrx3Jj-I8N-XiocWwN1mRxb5_pI&callback=initMap">
    </script>