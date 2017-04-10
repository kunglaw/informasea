<!-- <script>
window.fbAsyncInit = function() {
		
      FB.init({
        appId      : '1655530184684604', //app id informasea.com kunglaw
		//appId	  : '1618407731758628', // app id dr mbak rini
        xfbml      : true,
        version    : 'v2.4'
		//status     : true, 
        //cookie     : true,
        //oauth      : true,
      });
	  
	  /*
	  {
		status: 'connected',
		authResponse: {
			accessToken: '...',
			expiresIn:'...',
			signedRequest:'...',
			userID:'...'
		}
	  }*/
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
</script> -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
				 // 1069377543096061 mba rini 
				 // dimas, infrdev
      appId      : '1655530184684604', // api key rini, untuk dev
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>