   </div>
</div>

   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script>

$(document).ready(function() {

   $('tr:not(:first-child)').hover(
	  function(){
	  	$(this).addClass('success');
	  }, //end mouseover
	  
	  function(){
	  	$(this).removeClass('success');
	  } //end mouseout        
	  
	); //end hover

   $(".hideform").hide();

     $("#club_request").click(
   		function() {
   			var iteration=$(this).data('iteration')||1;
   			switch (iteration) {
   				case 1:
		     		$(".hideform").show();
					break;
				case 2:
					$(".hideform").hide();
					break;
			}
		iteration++;
		if (iteration>2) { iteration=1 };
		$(this).data('iteration',iteration);
   		}
	);

}); // end ready


</script>
    <script src="./includes/bootstrap.min.js"></script> 
  </body>
</html>
