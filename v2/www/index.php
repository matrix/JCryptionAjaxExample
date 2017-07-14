<?php session_start(); ?>

<html>
<head>
	<meta charset="utf-8">

	<style>
	.fieldset
	{
		display: inline-block;
	}

	.div
	{
		position:fixed;
		left:10px;
		top:30px;
	}
	</style>

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.jcryption.2.0.js"></script>
	<script type="text/javascript">

	var passphrase;

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++) text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}

	function jCryption_init()
	{
		var obj = new jsSHA(makeid(), "ASCII");
		passphrase = obj.getHash("SHA-1", "HEX");

		$.jCryption.authenticate(passphrase, "actions.php?generateKeypair=true", "actions.php?handshake=true", function(AESKey) {
			$("#username,#password,#submitLogin").attr("disabled",false);
		});
	}

	$(function()
	{
		jCryption_init();
<?php
		$_SESSION = array();
		session_destroy();
		//session_start();
?>

		$("#submitLogin").click(function() {
			// get username/password values
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;
			if (username == null) username = "";
			if (password == null) password = "";
			document.getElementById("username").value = '';
			document.getElementById("password").value = '';

			// encrypt data
			var dataString = "action=login&" + "username=" + username + "&password=" + password;
			var encryptedString = $.jCryption.encrypt(dataString, passphrase);

			$.ajax({
				url: '/actions.php',
				data: { jCryption : encryptedString },
				type: 'post',
				success: function(output) {
					if (output == 1)
					{
						$("#divLogin").hide();
						$("#divData").show();
						document.getElementById("status").innerHTML = '';
						// reset disabled attribute
						$("#username,#password,#submitLogin").attr("disabled",true);
					}
					else
					{
						$("#divData").hide();
						$("#divLogin").show();
						document.getElementById("status").innerHTML = 'Login failed';
					}
				}
			});
		});

		$("#submitGetData").click(function() {
			// encrypt data
			var dataString = "action=getData";
			var encryptedString = $.jCryption.encrypt(dataString, passphrase);

			$.ajax({
				url: '/actions.php',
				data: { jCryption : encryptedString },
				type: 'post',
				success: function(output) {
					if (output != 0)
					{
						document.getElementById("textData").value = output;
						document.getElementById("statusData").innerHTML = 'Success : ' + output;
					}
					else
					{
						document.getElementById("textData").value = '';
						document.getElementById("statusData").innerHTML = 'missing authentication';
					}
				}
			});
		});

		$("#submitSetData").click(function() {
			var txt = $("#textData").val();

			// encrypt data
			var dataString = "action=setData&data=" + txt;
			var encryptedString = $.jCryption.encrypt(dataString, passphrase);
			encryptedString = encodeURIComponent(encryptedString);

			$.ajax({
				url: '/actions.php?jCryption=' + encryptedString,
				type: 'get',
				success: function(output) {
					if (output != 0)
					{
						document.getElementById("textData").value = '';
						document.getElementById("statusData").innerHTML = 'Success : ' + output;
					}
					else
					{
						document.getElementById("statusData").innerHTML = 'missing authentication';
					}
				}
			});
		});

		$("#submitLogout").click(function() {
			// encrypt data
			var dataString = "action=logout";
			var encryptedString = $.jCryption.encrypt(dataString, passphrase);

			$.ajax({
				url: '/actions.php',
				data: { jCryption: encryptedString },
				type: 'post',
				success: function(output) {
					if (output == 1)
					{
						$("#divData").hide();
						$("#divLogin").show();
						document.getElementById("statusData").innerHTML = '';
						document.getElementById("status").innerHTML = 'Logged out';
						jCryption_init();
					}
				}
			});
		});
	});

	</script>
</head>
<body>

	<div id="divLogin" class="div">
		<fieldset class="fieldset">
			<legend>Login</legend>
			<table border="0" cellspacing="5" cellpadding="0">
			<tbody>
			<tr>
				<td>Username:</td>
				<td><input id="username" class="text" name="username" type="text" value="" disabled="disabled"/></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input id="password" class="text" name="password" type="password" value="" disabled="disabled"/></td>
			</tr>
			<tr>
				<td><input id="submitLogin" type="button" value="Login" disabled="disabled"/></td>
				<td><p id="status"></p></td>
			</tr>
			</tbody>
			</table>
		</fieldset>
	</div>

	<div id="divData" class="div">
		<fieldset class="fieldset">
		<legend>Data</legend>
			<input id="textData" type="text" value="">
			<br>
			<input id="submitSetData" type="button" value="Set Data"/>
			<input id="submitGetData" type="button" value="Get Data"/>
			<input id="submitLogout" type="button" value="Logout"/>
			<p id="statusData"></p>
		</fieldset>
	</div>

	<?php if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1) { ?>
	<script>
		$("#divLogin").hide();
		$("#divData").show();
	</script>
	<?php } else { ?>
	<script>
		$("#divLogin").show();
		$("#divData").hide();
	</script>
	<?php } ?>

</body>
</html>
