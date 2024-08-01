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
        <form action="" method="post" class="flex justify-center items-center p-4">
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
        } else {
            echo "<p class='text-center text-neutral-300'>You must book at least one room</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rooms = intval($_POST['rooms']);
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];

        countPrice($startDate, $endDate, $rooms);
    }
    ?>

    <?php require 'components/footer.php'; ?>
</body>

</html>






<?php
// class Book
// {

// private $rooms = [
// 'room1',
// 'room2',
// 'room3',
// ];

// private $roomPrice = 500;

// private $total;

// private $days = 1;

// function countPrice($rooms)
// {
// $this->total = $this->roomPrice * $rooms * $this->days;
// return $this->total;
// }
// }

// echo (new Book())->countPrice(3);
?>