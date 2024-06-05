<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Activity Log</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }
    </style>
</head>

<body class="flex flex-col">
    <header class="flex items-center justify-between p-1 bg-white shadow-md">
        <div class="flex items-center space-x-1">
            <img src="src/logo.png" alt="logo-website" class="h-16 w-20">
            <p class="text-xl font-bold">Ngamobil.</p>
        </div>
        <nav>
            <div class="hidden md:flex space-x-4 pr-8">
                <a href="#" class="rounded-md text-black hover:text-gray-500 p-2">Home</a>
                <a href="#" class="rounded-md text-black hover:text-gray-500 p-2">Contact</a>
            </div>
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Log Aktivitas</h2>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nama Mobil</th>
                        <th class="py-2 px-4 border-b">Waktu Peminjaman</th>
                        <th class="py-2 px-4 border-b">Waktu Pengembalian</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    <tr>
                        <td class="py-2 px-4 border-b">Toyota Avanza</td>
                        <td class="py-2 px-4 border-b">01/06/2024 08:00</td>
                        <td class="py-2 px-4 border-b">03/06/2024 08:00</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Perpanjang</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Batalkan</button>
                        </td>
                    </tr>
                    <!-- More rows can be added here -->
                </tbody>
            </table>
        </div>
    </div>
    <footer class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-between">
                <div>
                    <h3 class="font-bold">Reservation</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Car Hire</a></li>
                        <li><a href="#" class="hover:underline">Modify Or Cancel</a></li>
                        <li><a href="#" class="hover:underline">Get A Receipt</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold">Customer Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Help / FAQS</a></li>
                        <li><a href="#" class="hover:underline">Press</a></li>
                        <li><a href="#" class="hover:underline">Blog</a></li>
                        <li><a href="#" class="hover:underline">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">About Us</a></li>
                        <li><a href="#" class="hover:underline">Career</a></li>
                        <li><a href="#" class="hover:underline">Report & Governance</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-between items-center mt-4">
                <div>&copy; 2024 NGAMOBIL</div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:underline">Twitter</a>
                    <a href="#" class="hover:underline">Facebook</a>
                    <a href="#" class="hover:underline">Instagram</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>