<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="google-signin-client_id"
          content="404188851068-rceqc09qshup5hchtluictv6re09gndb.apps.googleusercontent.com">
</head>
<body>
<center>


    <h1>Login Page</h1>
    Login with Google
    <div class="g-signin2" id="gSignIn"></div>

    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>

    <script>
        function renderButton() {
            gapi.signin2.render('gSignIn', {
                'scope': 'profile email',
                'longtitle': true,
                'theme': 'dark',
                'onsuccess': onSuccess,
            });
        }

        // Sign-in success callback
        function onSuccess(googleUser) {
            // Get the Google profile data (basic)
            var profile = googleUser.getBasicProfile();
            console.log('Google profile name: ' + profile.getEmail());
            console.log('Google profile mail: ' + profile.getName());

        }

    </script>
    <script>
        //FACEBOOK LOGIN SCRIPT

        function statusChangeCallback(response) {
            console.log(response);
            if (response.status === 'connected') {
// Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
// The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Login with Facebook ';
            } else {
// The person is not logged into Facebook, so we're not sure if
// they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Login with Facebook ';
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '559759961606436',
                cookie: true,
                xfbml: true,
                version: 'v7.0'
            });

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function testAPI() {
            console.log('Welcome! Fetching your information.... ');
            FB.api('/me?fields=name,email', function (response) {
                console.log('Facebook profile name: ' + response.name);
                console.log('Facebook profile mail: ' + response.email);

                document.getElementById("status").innerHTML = '<p>Welcome ' + response.name + ' ' + response.email + '! '
            });
        }





    </script>
    <!--
    Below we include the Login Button social plugin. This button uses
    the JavaScript SDK to present a graphical Login button that triggers
    the FB.login() function when clicked.
    -->
    <br><br>
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>
    <div id="status">
    </div>

    <br><br>
    </center>


</body>
</html>
