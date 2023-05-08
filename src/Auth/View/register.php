<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HackNet Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="/public/css/global/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container bg-black bg-opacity-80 p-8 border-2 border-green-500 rounded-lg w-80 shadow-md">
        <h1 class="text-center text-2xl font-bold mb-6 text-green-500">HackNet Registration</h1>
        <form>
            <div class="mb-4">
                <label for="username" class="block mb-2 font-bold text-green-500">Username:</label>
                <input type="text" id="username" name="username" class="w-full bg-black text-green-500 border-2 border-green-500 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 font-bold text-green-500">Password:</label>
                <input type="password" id="password" name="password" class="w-full bg-black text-green-500 border-2 border-green-500 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 font-bold text-green-500">Confirm Password:</label>
                <input type="password" id="password" name="password" class="w-full bg-black text-green-500 border-2 border-green-500 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 font-bold text-green-500">Email:</label>
                <input type="password" id="password" name="password" class="w-full bg-black text-green-500 border-2 border-green-500 p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-green-500 text-black font-bold p-2 rounded cursor-pointer hover:opacity-80">Login</button>
        </form>
    </div>
</body>
</html>