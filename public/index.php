<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Link to your styles.css file -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Your HTML content here -->
</body>
</html>

</head>
<body>
    <header class="bg-blue-500 text-white p-4">
        <h1 class="text-3xl">Car Rental</h1>
    </header>
    <main class="p-4">
        <h2 class="text-2xl">Welcome to Car Rental</h2>
        <!-- Your content here -->
    </main>
    <footer class="bg-blue-500 text-white p-4 mt-4">
        <p>&copy; 2024 Car Rental</p>
    </footer>
    <main class="p-4">
        <h2 class="text-2xl mb-4">Book a Car</h2>
        <form action="book.php" method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-lg">Name</label>
                <input type="text" id="name" name="name" class="border p-2 w-full">
            </div>
            <div>
                <label for="car" class="block text-lg">Car Model</label>
                <input type="text" id="car" name="car" class="border p-2 w-full">
            </div>
            <div>
                <label for="date" class="block text-lg">Booking Date</label>
                <input type="date" id="date" name="date" class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Book Now</button>
        </form>
    </main>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $car = htmlspecialchars($_POST['car']);
        $date = htmlspecialchars($_POST['date']);

        // For now, just display the booking info
        echo "<h1>Booking Confirmation</h1>";
        echo "<p>Name: $name</p>";
        echo "<p>Car Model: $car</p>";
        echo "<p>Booking Date: $date</p>";
    } else {
        echo "<p>Invalid Request</p>";
    }
    ?>
</body>
</html>
