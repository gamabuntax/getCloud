   </div>
</div>

   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
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
}); // end ready


</script>
    <script src="./includes/bootstrap.min.js"></script> 
  </body>
</html>
