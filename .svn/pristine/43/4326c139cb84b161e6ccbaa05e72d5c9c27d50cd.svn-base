<?php

	$this->load->model("seaman/resume_data");
	//$this->resume_data->get_json_ship();

?>

<script>
$(document).ready(function(e) {
     var avaiableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
			];
			

			
		var ab = jQuery.noConflict();
		ab("#test").autocomplete({
			 //source: avaiableTags,
			 source: "<?php echo base_url("seaman/resume/resume_data?function=ship_json")?>",
			 select: function( event, ui ) {
				$("#test").val(ui.item.value);
				return false;
				},
		 	focus:function(event,ui){
				$("#test").val(ui.item.value);
				return false;
			},
			
		});
});
 
</script>

<input type="text" value="" name="test" class="test" id="test" /> 


<select>


</select>