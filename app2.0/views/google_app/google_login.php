<?php include "google_platform.php" ?>

<form id="google-form" role="form" style="display:none" method="post">

    <input type="hidden" value="google_form" />

    <input type="hidden" value="" name="google_id" id="google_id" />

    <input type="hidden" value="" name="google_firstname" id="google_firstname" />

    <input type="hidden" value="" name="google_lastname" id="google_lastname"/>

    <input type="hidden" name="google_city" id="google_city" />

    <!-- <input type="hidden" name="google_address" id="google_address"/>

    <input type="hidden" name="google_birthday" id="google_birthday"/> -->

    <input type="hidden" name="google_cover" id="google_cover" />

    <input type="hidden" name="google_picture" id="google_picture" />

    <input type="hidden" name="google_email" id="google_email"/>

    <input type="hidden" name="google_gender" id="google_gender"/>

    

    <!-- <input type="hidden" name="google_username" id="google_username" />

    <input type="hidden" name="google_password" id="google_password" /> -->

    

    <input type="submit" value="google_submit" id="google_submit" />

</form>



<script>

  var googleUser = {};

  var startApp = function() {

    gapi.load('auth2', function(){

      // Retrieve the singleton for the GoogleAuth library and set up the client.

      auth2 = gapi.auth2.init({
				  //916641311518-souvcjua8h9hvhbu9jr9kahlsl383iiu.apps.googleusercontent.com
        client_id: '916641311518-souvcjua8h9hvhbu9jr9kahlsl383iiu.apps.googleusercontent.com',

        cookiepolicy: 'single_host_origin',

        // Request scopes in addition to 'profile' and 'email'

        scope: 'profile'

      });

      attachSignin(document.getElementById('btn-google-login'));
	  attachSignin(document.getElementById('btn-google-login-register'));

    });

  };

	

  /**

   * Handler for the signin callback triggered after the user selects an account.

   */

  function onSignInCallback(resp) {

    gapi.client.load('plus', 'v1', apiClientLoaded);

	//alert("jalan 1");

  }



  /**

   * Sets up an API call after the Google API client loads.

   */

  function apiClientLoaded() {			// maksudnya me adalah userID yang sedang aktif saat ini 

    gapi.client.plus.people.get({userId: 'me'}).execute(retrieveData);

	//alert("jalan 2");

  }	

  

  function retrieveData(resp)

  {

	//alert("jalan 3");

	var data = JSON.stringify(resp);

	

	if(!resp.hasOwnProperty('cover'))

	{

		cov = "";	

	}

	else

	{

		cov = resp.cover.coverPhoto.url;	

	}

	

	if(!resp.hasOwnProperty('image'))

	{

		pic = "";	

	}

	else

	{

		pic = resp.image.url;	

	}



	

	$("#google_id").val(resp.id);

	$("#google_email").val(resp.emails[0].value);

	$("#google_gender").val(resp.gender);

	$("#google_firstname").val(resp.name.givenName);

	$("#google_lastname").val(resp.name.familyName);

	$("#google_picture").val(pic);

	$("#google_cover").val(cov);

	

	submit_data();

  }

  

  function setCookie(cname, cvalue, hours) {

	  var d = new Date();

	  d.setTime(d.getTime() + (hours*60*60*1000));

	  var expires = "expires="+d.toUTCString();

	  document.cookie = cname + "=" + cvalue + "; " + expires;

  } 

  

  function submit_data()

  {

	$.ajax({

		

		type:"POST",

		url:"<?=base_url("users/users_sosmed/gmail")?>",

		data:$("#google-form").serialize(),

		//contentType:"json",

		dataType:"json",

		error: function(err)

		{

			alert(err.responseText);

		},

		success: function(response){

			

			alert(response.msg);

			

			if(jQuery.isEmptyObject(response.cookie) == false)

			{

				

				setCookie("name",response.cookie.name,2);

				setCookie("photo",response.cookie.photo,2);

				setCookie("username",response.cookie.username,2);

				setCookie("cover",response.cookie.cover,2);

			}

			

			location.href = response.url;

			

		}

		

	}); 

	  

  }

  

  function attachSignin(element) {

    //console.log(element.id);

    auth2.attachClickHandler(element, {},

        function(googleUser) {

	

			//alert(googleUser.getBasicProfile().getId());

			onSignInCallback(googleUser);

          /* document.getElementById('name').innerHTML = "Signed in: " +

             // googleUser.getBasicProfile().getName();

			 googleUser.getHostedDomain();

			  //alert(googleUser.getBasicProfile().getName());*/

        }, function(error) {

          //alert(JSON.stringify(error, undefined, 2));

        });

  }

</script>

<script>startApp();</script>