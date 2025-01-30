<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Login</h1>
    <form action="auth.php" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700">Username</label>
        <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded-lg" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg" required>
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Login</button>
    </form>
  </div>
</body>
</html>