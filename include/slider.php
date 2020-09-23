<div class="header_slider">
  <script type="text/javascript" src="js/camera.js"></script>
  <script type="text/javascript">
 /* index slider */
 jQuery(function(){
 jQuery('#camera_wrap').camera({
 alignmen: 'topCenter',
 height: '29.880%',
 minHeight: '50px',
 loader : false,
 pagination: false,
 fx: 'simpleFade',
 navigationHover:false,
 thumbnails: false,
 playPause: false 
 });
 });
 </script>
  <div class="fluid_container">
    <div class="camera_wrap camera_orange_skin" id="camera_wrap">
      <div data-src="images/slider_pic1.jpg"></div>
      <div data-src="images/slider_pic2.jpg"></div>
      <div data-src="images/slider_pic3.jpg">
        <div class="camera_caption fadeIn"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>