<?php
include 'db.php';

$sql = "SELECT * FROM reservations";
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

<body class="bg-slate-800">
    <section>
        <?php require 'components/navbar.php'; ?>
        <h1 class="text-4xl text-center font-bold text-neutral-300 p-4">Reservations</h1>
    </section>
    <section class="flex justify-center items-center p-4">
        <table class="table-auto border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">ID</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Name</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Email</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Phone</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Room Amount</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Start Date</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">End Date</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Paid</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Done</th>
                    <th class="border text-neutral-300 border-slate-300 px-4 py-2">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['id'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['name'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['email'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['phone'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['room_amount'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['start_date'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['end_date'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['paid'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['done'] . "</td>";
                        echo "<td class='border text-neutral-300 border-slate-300 px-4 py-2'>" . $row['price'] . " dkk" . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='border border-slate-300 px-4 py-2 text-center'>No reservations found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <?php require 'components/footer.php'; ?>
</body>

</html>
</body>

</html>