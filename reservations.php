<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = intval($_POST['reservation_id']);
    if (isset($_POST['mark_paid'])) {
        $sql = "UPDATE reservations SET paid = 1 WHERE id = $reservationId";
        $conn->query($sql);
    } elseif (isset($_POST['mark_done'])) {
        $sql = "UPDATE reservations SET done = 1 WHERE id = $reservationId";
        $conn->query($sql);
    }
}

$sql = "SELECT r.id, u.name, u.email, u.phone, r.room_amount, r.start_date, r.end_date, r.paid, r.done, r.price
        FROM reservations r
        JOIN users u ON r.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="bg-slate-800 text-neutral-300">
    <header>
        <?php require 'components/navbar.php'; ?>
    </header>
    <main class="p-4">
        <h1 class="text-4xl font-bold text-center mb-6">Reservations</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-600">
                <thead class="bg-slate-700">
                    <tr>
                        <?php
                        $headers = [
                            'ID', 'Name', 'Email', 'Phone', 'Room Amount', 'Start Date', 'End Date', 'Paid', 'Done', 'Price', 'Actions'
                        ];
                        foreach ($headers as $header) {
                            echo "<th class='px-6 py-3 text-left text-xs font-medium text-neutral-400 uppercase tracking-wider'>{$header}</th>";
                        }
                        ?>
                    </tr>
                </thead>

                <tbody class="bg-slate-800 divide-y divide-slate-700">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                $value = htmlspecialchars($value);
                                if ($key === 'price') {
                                    echo "<td class='px-6 py-4 text-sm font-medium text-neutral-300'>{$value} dkk</td>";
                                } elseif ($key === 'paid' || $key === 'done') {
                                    echo "<td class='px-6 py-4 text-sm text-neutral-300'>" . ($value ? '1' : '0') . "</td>";
                                } else {
                                    echo "<td class='px-6 py-4 text-sm text-neutral-300'>{$value}</td>";
                                }
                            }
                            echo "<td class='px-6 py-4 text-sm text-right'>
                                    <div class='flex justify-end space-x-2'>
                                        <form method='post' action=''>
                                            <input type='hidden' name='reservation_id' value='{$row['id']}'>
                                            <button type='submit' name='mark_paid' class='bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded'>Paid</button>
                                        </form>
                                        <form method='post' action=''>
                                            <input type='hidden' name='reservation_id' value='{$row['id']}'>
                                            <button type='submit' name='mark_done' class='bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Done</button>
                                        </form>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='px-6 py-4 text-center text-sm text-neutral-400'>No reservations found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php require 'components/footer.php'; ?>

    <?php $conn->close(); ?>
</body>

</html>