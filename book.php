<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="bg-slate-800 text-neutral-300">
    <?php require 'components/navbar.php'; ?>

    <main class="p-4 md:p-8">
        <section class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Book Your Room</h1>
            <form action="" method="post" class="max-w-lg mx-auto bg-slate-700 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-medium">Phone</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="rooms" class="block text-lg font-medium">Number of Rooms</label>
                    <input type="number" id="rooms" name="rooms" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="start_date" class="block text-lg font-medium">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block text-lg font-medium">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="mt-1 block w-full p-2 rounded-lg border border-slate-500 bg-slate-600 text-neutral-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full text-2xl font-bold bg-blue-600 hover:bg-blue-700 text-white rounded-lg p-3">Book Now</button>
            </form>
        </section>

        <section class="text-center mt-8">
            <?php
            function countPrice($startDate, $endDate, $rooms)
            {
                $dayPrice = 500;

                if ($rooms > 0) {
                    $startDate = new DateTime($startDate);
                    $endDate = new DateTime($endDate);

                    $diff = $startDate->diff($endDate)->format("%a");

                    echo "<p class='text-lg text-neutral-300 mb-2'>Days difference: " . $diff . "</p>";
                    $total = ($diff * $dayPrice) * $rooms;
                    echo "<p class='text-lg text-neutral-300'>Total price: dkk " . $total . "</p>";

                    return $total;
                } else {
                    echo "<p class='text-lg text-neutral-300'>You must book at least one room</p>";
                    return 0;
                }
            }

            include 'db.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $rooms = intval($_POST['rooms']);
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $price = countPrice($start_date, $end_date, $rooms);

                if ($price > 0) {
                    $sql = "INSERT INTO reservations (name, email, phone, room_amount, start_date, end_date, price) VALUES (?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssissi", $name, $email, $phone, $rooms, $start_date, $end_date, $price);

                    if ($stmt->execute()) {
                        echo "<p class='text-lg text-neutral-300 mt-4'>Your reservation has been accepted</p>";
                    } else {
                        echo "<p class='text-lg text-red-400 mt-4'>Error: " . $stmt->error . "</p>";
                    }

                    $stmt->close();
                }
            }
            ?>
        </section>
    </main>

    <?php require 'components/footer.php'; ?>
</body>

</html>