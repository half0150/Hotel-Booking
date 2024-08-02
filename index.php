<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monie's Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="bg-slate-800 text-neutral-300">
    <?php require 'components/navbar.php'; ?>

    <main class="p-4 md:p-12">
        <section class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Monie's Hotel</h1>
            <p class="text-lg md:text-xl mb-8">Welcome to Monie's Hotel, where comfort meets elegance.</p>
            <div class="flex justify-center items-center">
                <img class="w-full max-w-3xl rounded-lg shadow-xl" src="images/receptionists-5975962_640.jpg" alt="receptionists">
            </div>
        </section>
    </main>

    <?php require 'components/footer.php'; ?>
</body>

</html>