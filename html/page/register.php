<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form method="post" action="page/_script/register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email"><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
