<html>
<head>
</head>
<body>
<p>
<b>STEP 1: GET THE ACCESS CODE</b> (after you have the access code, you need to save it in a note)<br /> 
<?php 
$app_key = "";
$secret_key= "";
$access_code = "";
if(isset($_POST['app_key'])) {
    $app_key = $_POST['app_key'];    
}
?>
<form action="index.php" method="post">
What is your App key: <input type="text" value="<?php echo $app_key; ?>" name="app_key" />
<input type="submit" />
</form>
<?php 
if($app_key != "") {
    echo '<b>Please click here to approve the permission and then get ACCESS CODE: <a target="_blank" href="https://www.dropbox.com/oauth2/authorize?client_id='.$app_key.'&token_access_type=offline&response_type=code
">GET PERMISSION</a></b>';
}
?>
</p>
<hr />
<p>
<?php 
if(isset($_POST['app_key']) && isset($_POST['secret_key']) && isset($_POST['access_code'])) {
    $app_key = $_POST['app_key'];
    $secret_key = $_POST['secret_key'];    
    $authorization = base64_encode("$app_key:$secret_key");
    $access_code = $_POST['access_code'];
}
?>
<b>STEP 2: GET THE LONG TERM REFRESH TOKEN</b><br />
<form action="index.php" method="post">
What is your App key: <input type="text" value="<?php echo $app_key; ?>" name="app_key" /> <br />
What is your secret key: <input type="text" value="<?php echo $secret_key; ?>" name="secret_key" /> <br />
What is your Access code: <input type="text" value="<?php echo $access_code; ?>" name="access_code" /><br />
Click here to get your long term refresh toke: <input type="submit" name="get_long_term_refresh_token" />
</form>
</p>
<hr />
<p style="width:100%; text-align:center;">
	<spand id="refresh_token" style="color:red; font-size:20px; font-weight:bold;">This is your REFRESH TOKEN</spand>
</p>
<?php 
if(isset($_POST['app_key']) && isset($_POST['secret_key']) && isset($_POST['access_code'])) {
    $app_key = $_POST['app_key'];
    $secret_key = $_POST['secret_key'];    
    $authorization = base64_encode("$app_key:$secret_key");
    $access_code = $_POST['access_code'];
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
		    var settings = {
                              "url": "https://api.dropboxapi.com/oauth2/token",
                              "method": "POST",
                              "timeout": 0,
                              "headers": {
                                "Authorization": "Basic <?php echo $authorization; ?>",
                                "Content-Type": "application/x-www-form-urlencoded"
                              },
                              "data": {
                                "code": "<?php echo $access_code; ?>",
                                "grant_type": "authorization_code"
                              }
                            };
            
            $.ajax(settings).done(function (response) {
            	alert("Below is your LONG TERM refresh token!!!!");
            	$("#refresh_token").html("This is your long term refresh token: " + response.refresh_token);			
            }).fail(function(){
            	alert("please do again - your access code may be expired");
            	$("#refresh_token").html("you should do step 1 to step 2 again");
            });
      
    
    });

    </script>
<?php    
}
?>
</body>
</html>
