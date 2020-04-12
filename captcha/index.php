<html>
<head>
<title>Simple CAPTCHA Generator</title>
<style>
.button {
	box-shadow:inset 0px 0px 0px 0px #fce2c1;
	background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
	background-color:#ffc477;
	border-radius:42px;
	border:1px solid #eeb44f;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:28px;
	padding:32px 76px;
	text-decoration:none;
	text-shadow:0px 1px 0px #cc9f52;
	vertical-align:middle;
}
.button:hover {
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	background-color:#fb9e25;
}
.button:active {
	position:relative;
	top:1px;
}

</style>
</head>
	<body bgcolor="0E0E0E">
	<div style="text-align:center; margin-top: 300px;">
		<a href="http://localhost:8080/captcha/generate.php" target="_blank" class="button">Generate CAPTCHA
		</a>
	</div>
	</body>
</html>
