<?php // js_under, module timeline ?>
<!-- lightbox -->
<!-- <script type="text/javascript" src="<?=base_url("plugin/lightbox/ekko-lightbox.js");?>"></script> 
<script type="text/javascript" src="<?php echo asset_url('js/jquery-1.11.2.min.js') ?>"></script>-->
<script>
	function list_friend()
   {
		var result;
		$.ajax({
			type:"POST",
			url:"<?=base_url("timeline/list_friend")?>",
			dataType:"json",
			data:"x=1",
			error: function(err)
			{	
				alert("ERROR = "+err.responseText);	
			},
			success: function(res){
				
				alert("RES = "+res.toSource());
			}
			
		}); 
		
		
	   
   }

   function Show_Modal(argument, id) {
   	// body...
   	$.ajax({
   		url : "<?php echo base_url('timeline/show_modal') ?>",
   		data: "x=1&for="+argument+"&id="+id,
   		type: "POST",
   		success: function (output) {
   			// body...
   			$(".tml-modal-alert").html(output);
   		}
   	});
   }

	
	$(document).ready(function(e) {
		
    });

	
      hljs.initHighlightingOnLoad();
    	// configure marked
  		var renderer = new marked.Renderer();
  		renderer.table = function (header, body) {
  			return '\
  				<table class="table table-bordered table-striped table-hover">\
  					<thead>\
  						' + header + '\
  					</thead>\
  					<tbody>\
  						' + body + '\
  					</tbody>\
  				</table>';
  		},

  		marked.setOptions({
  			sanitize: false,
  			highlight: function (code) {
  		    	return hljs.highlightAuto(code).value;
  		  	},
  		  	renderer: renderer,
  		  	breaks: true
  		});

      	$.fn.extend({
      		marked: function() {
  				this.each(function() {
  					$this = $(this);
  					$this.html(marked($this.html()));
  				})

  				return this;
  			},
      	});
		
		
		// error nya disini 
      	$(function() {
			
			
      		$('.markdown').marked();
			
			// data
			/* var users = [
			  {username: 'lodev09', fullname: 'Jovanni Lo'},
			  {username: 'foo', fullname: 'Foo User'},
			  {username: 'bar', fullname: 'Bar User'},
			  {username: 'twbs', fullname: 'Twitter Bootstrap'},
			  {username: 'john', fullname: 'John Doe'},
			  {username: 'jane', fullname: 'Jane Doe'},
			]; */

		 var users = function () {
			  var tmp = null;
			  $.ajax({
				  async: false,
				  type:"POST",
				  data:"x=1",
				  url:"<?=base_url("timeline/list_friend")?>",
				  dataType:"json",
				  global: false,
				  'success': function (data) {
					  tmp = data;
				  }
			  });
			  return tmp;
		  }();
		  
		  
		  // var users = list_friend();
		
          $('.timeline-input-to').suggest('@', {
            data: users,
            map: function(user) {
              return {
                value: user.username,
                text: '<img src="'+user.profile_pic+'" width="30" height="30" style="border:1px solid grey"> &nbsp; <strong>'+user.username+'</strong> <small>'+user.fullname+'</small>'
              }
            }
          });

          
		  
		 

      	}); 
		
    </script>
    
    <!-- HOMINA HOMINA -->

<script type="text/javascript">
    /* $(document).ready(function ($) {
        // delegate calls to data-toggle="lightbox"
        $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
            event.preventDefault();
            return $(this).ekkoLightbox({
                onShown: function() {
                    if (window.console) {
                        return console.log('Checking our the events huh?');
                    }
                },
                onNavigate: function(direction, itemIndex) {
                    if (window.console) {
                        return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                    }
                }
            });
        });
		
		lightbox.option({
		  'resizeDuration': 200,
		  'wrapAround': true,
		})


    }); */
</script>
