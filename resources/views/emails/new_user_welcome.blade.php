<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
    <p>Hello, {{ $user->name }}</p>
    <p>Welcome to our company!</p>
    <p>This is your login credentials:</p>
    <ul>
        <li><strong>Username:</strong> {{ $user->UserName }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> NewUser</li>
    </ul>
    <p>Your NIWOS account was successfully created by the administrator.</p>
    <p>Please update your informations in the NIWOS app 😊.</p>
</body>
</html>
