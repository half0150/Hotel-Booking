<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="bg-slate-800">
    <section>
        <?php require 'components/navbar.php'; ?>
        <h1 class="text-4xl text-center font-bold text-neutral-300 p-4">Book your room</h1>
    </section>
    <section>
        <form action="" method="post" class="flex flex-col justify-center items-center p-4">
            <label class="text-neutral-300 text-lg">Name</label>
            <input type="text" name="name" class="p-2 m-2 rounded-lg" required>
            <label class="text-neutral-300 text-lg">Email</label>
            <input type="email" name="email" class="p-2 m-2 rounded-lg" required>
            <label class="text-neutral-300 text-lg">Phone</label>
            <input type="tel" name="phone" class="p-2 m-2 rounded-lg" required>
            <label for="rooms" class="text-neutral-300 text-lg">Number of rooms:</label>
            <input type="number" name="rooms" id="rooms" class="p-2 m-2 rounded-lg" required>
            <label for="start_date" class="text-neutral-300 text-lg">Start:</label>
            <input type="date" name="start_date" id="start_date" class="p-2 m-2 rounded-lg" required>
            <label for="end_date" class="text-neutral-300 text-lg">End:</label>
            <input type="date" name="end_date" id="end_date" class="p-2 m-2 rounded-lg" required>
            <button type="submit" class="text-2xl font-bold bg-slate-50 rounded-lg p-2">Book</button>
        </form>
    </section>

    <?php
    function countPrice($startDate, $endDate, $rooms)
    {
        $dayPrice = 500;

        if ($rooms > 0) {
            $startDate = new DateTime($startDate);
            $endDate = new DateTime($endDate);

            $diff = $startDate->diff($endDate)->format("%a");

            echo "<p class='text-center text-neutral-300'>Days difference: " . $diff . "</p>";
            echo "<br>";

            $total = ($diff * $dayPrice) * $rooms;
            echo "<p class='text-center text-neutral-300'>Total price: dkk " . $total . "</p>";

            return $total;
        } else {
            echo "<p class='text-center text-neutral-300'>You must book at least one room</p>";
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
                echo "<p class='text-center text-neutral-300'>You reservation has been accepted</p>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    ?>

    <?php require 'components/footer.php'; ?>
</body>

</html>