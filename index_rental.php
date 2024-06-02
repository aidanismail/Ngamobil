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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .card {
      @apply w-full max-w-xs rounded-lg shadow-lg bg-gray-200;
    }
    .card-content {
      @apply p-4 bg-white rounded-tl-lg rounded-tr-lg;
    }
    .card-footer {
      @apply p-4 bg-blue-800 text-white rounded-bl-lg rounded-br-lg;
    }
    .card-title {
      @apply text-2xl text-blue-900;
    }
    .card-price {
      @apply text-xl text-blue-900;
    }
    .card-detail {
      @apply text-base text-gray-900;
    }
  </style>
</head>
<body class="bg-white">
  <div class="w-full max-w-screen-xl mx-auto px-4">
    <!-- Header -->
    <header class="w-full py-8 bg-blue-900 text-white">
      <div class="flex justify-between items-center max-w-screen-xl mx-auto">
        <div>
          <h1 class="text-4xl">NGAMOBIL</h1>
          <nav class="flex space-x-8 mt-4">
            <a href="#" class="text-lg">Reservation</a>
            <a href="#" class="text-lg">Customer Services</a>
            <a href="#" class="text-lg">Company</a>
          </nav>
        </div>
        <div class="flex space-x-6">
          <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"><path fill="white" d="M20 0C8.955 0 0 8.955 0 20C0 31.045 8.955 40 20 40C31.045 40 40 31.045 40 20C40 8.955 31.045 0 20 0ZM25 13.3333H22.75C21.8533 13.3333 21.6667 13.7017 21.6667 14.63V16.6667H25L24.6517 20H21.6667V31.6667H16.6667V20H13.3333V16.6667H16.6667V12.82C16.6667 9.87167 18.2183 8.33333 21.715 8.33333H25V13.3333Z"/></svg>
          <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"><path fill="white" d="M24.715 10.5033C23.485 10.4467 23.115 10.4367 20 10.4367C16.885 10.4367 16.5167 10.4483 15.2867 10.5033C12.1217 10.6483 10.6483 12.1467 10.5033 15.2867C10.4483 16.5167 10.435 16.885 10.435 20C10.435 23.115 10.4483 23.4833 10.5033 24.715C10.6483 27.8467 12.115 29.3533 15.2867 29.4983C16.515 29.5533 16.885 29.5667 20 29.5667C23.1167 29.5667 23.485 29.555 24.715 29.4983C27.88 29.355 29.3517 27.8517 29.4983 24.715C29.5533 23.485 29.565 23.115 29.565 20C29.565 16.885 29.5533 16.5167 29.4983 15.2867C29.3517 12.1483 27.8767 10.6483 24.715 10.5033ZM20 25.9917C16.6917 25.9917 14.0083 23.31 14.0083 20C14.0083 16.6917 16.6917 14.01 20 14.01C23.3083 14.01 25.9917 16.6917 25.9917 20C25.9917 23.3083 23.3083 25.9917 20 25.9917ZM26.2283 15.1733C25.455 15.1733 24.8283 14.5467 24.8283 13.7733C24.8283 13 25.455 12.3733 26.2283 12.3733C27.0017 12.3733 27.6283 13 27.6283 13.7733C27.6283 14.545 27.0017 15.1733 26.2283 15.1733Z"/></svg>
          <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"><path fill="white" d="M20 0C8.955 0 0 8.955 0 20C0 31.045 8.955 40 20 40C31.045 40 40 31.045 40 20C40 8.955 31.045 0 20 0ZM25 13.3333H22.75C21.8533 13.3333 21.6667 13.7017 21.6667 14.63V16.6667H25L24.6517 20H21.6667V31.6667H16.6667V20H13.3333V16.6667H16.6667V12.82C16.6667 9.87167 18.2183 8.33333 21.715 8.33333H25V13.3333Z"/></svg>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main class="py-16">
      <h2 class="text-5xl text-center text-black">Pilih teman anda untuk hari ini</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
        <!-- Card 1 -->
        <div class="card">
          <img src="images/image-5.png" alt="Toyota Agya" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Agya</h3>
            <p class="card-detail">2016 - 15k - Auto - Pertamax</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 1.500.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="card">
          <img src="images/png-transparent-toyota-avanza-car-minivan-toyota-fortuner-toyota-compact-car-car-mode-of-transport-removebg-preview-removebg-preview-1.png" alt="Toyota Avanza" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Avanza</h3>
            <p class="card-detail">2016 - 15k - Auto - Pertalite</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 500.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="card">
          <img src="images/image-1.png" alt="Toyota Agya" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota GT-86</h3>
            <p class="card-detail">2016 - 15k - Manual - Pertamax</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 300.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="card">
          <img src="images/image-2.png" alt="Toyota Camry" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Camry</h3>
            <p class="card-detail">2019 - 20k - Auto - Pertamax</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 2.000.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="card">
          <img src="images/image-3.png" alt="Toyota Fortuner" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Fortuner</h3>
            <p class="card-detail">2020 - 10k - Auto - Diesel</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 3.000.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="card">
          <img src="images/image-4.png" alt="Toyota Hilux" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Hilux</h3>
            <p class="card-detail">2021 - 5k - Auto - Diesel</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 2.500.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 7 -->
        <div class="card">
          <img src="images/image-6.png" alt="Toyota Yaris" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Yaris</h3>
            <p class="card-detail">2018 - 25k - Manual - Pertamax</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 1.200.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 8 -->
        <div class="card">
          <img src="images/image-7.png" alt="Toyota Vios" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Vios</h3>
            <p class="card-detail">2017 - 30k - Manual - Pertalite</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 1.000.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>

        <!-- Card 9 -->
        <div class="card">
          <img src="images/image-8.png" alt="Toyota Alphard" class="w-full h-48 object-cover rounded-t-lg">
          <div class="card-content">
            <h3 class="card-title">Toyota Alphard</h3>
            <p class="card-detail">2022 - 8k - Auto - Pertamax</p>
          </div>
          <div class="card-footer">
            <p class="card-price">Rp 4.000.000</p>
            <button class="bg-white text-blue-800 py-2 px-4 rounded-lg">Rental</button>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-8 bg-blue-900 text-white">
      <div class="flex justify-between items-center max-w-screen-xl mx-auto">
        <p class="text-xl">© 2023 NGAMOBIL. All rights reserved.</p>
        <div class="flex space-x-8">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </footer>
  </div>
</body>
</html>
