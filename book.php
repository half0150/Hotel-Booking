<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js">
    </script>
</head>

<body class="bg-slate-800">
    <?php require 'components/navbar.php'; ?>
    <h1 class="text-4xl text-center font-bold text-neutral-300 p-4">Book your room</h1>
</body>

</html>

<?php

class Book
{

    // private $rooms = [
    //     'room1',
    //     'room2',
    //     'room3',
    // ];

    private $roomPrice = 500;

    private $total;

    private $days = 1;

    function countPrice($rooms)
    {
        $this->total = $this->roomPrice * $rooms * $this->days;
        return $this->total;
    }
}

// echo (new Book())->countPrice(3);
