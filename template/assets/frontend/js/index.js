(function($) {
  'use strict';
  $(function() {
   console.log('index js is loading . . .');
   //onchange image file show it on right side 
  
  });

})(jQuery);
function readURL(input)
{
	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function (e) {
	        $('#demo_profile_img').attr('src', e.target.result);
	    };
	    reader.readAsDataURL(input.files[0]);
	}
}