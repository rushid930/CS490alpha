<?php
  include_once 'includes/dblog.php';
?>

<html>
<body>

<h1>Test Form</h1>

<form action="/action_page.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password"><br><br>
</form>
<button onclick="submitFunction()">Login</button>

<script>
    function submitFunction() {
      location.replace("https://web.njit.edu/~rd448/reject.html")
    }
</script>

</body>
</html>