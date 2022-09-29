<!--
<button onclick="submitFunction()">Login</button>

<script>
    function submitFunction() {
      location.replace("https://web.njit.edu/~rd448/acceptStudent.html")
    }
</script>
-->
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
</head>
<body>
	<div id="LoginForm">
		<h2>Login Form</h2>
		<form id="Login">
      <label for="username">Username:</label>
			<input type="text" id="username" name="username"><br/>
			<label for="password">Password: </label>
      		<input type="text" id="password" name="password"><br/>
			<input type="submit" value="LOGIN"/>
		</form>
	</div>
  	<div id="response">
	</div>
<script src="login.js"></script>
</body>
</html>