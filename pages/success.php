<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-3xl font-bold mb-4">Payment Successful!</h1>
        <p class="text-lg mb-4">Thank you for your purchase.</p>
        <p class="text-lg mb-4">You will now be redirected to the selection page.</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "../pages/index_pemilihan.php";
        }, 3000); // Redirect after 3 seconds
    </script>
</body>

</html>