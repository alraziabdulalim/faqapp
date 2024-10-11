<?php

session_start();
$is_logged_in = isset($_SESSION['user_id']);

require "helpers.php";

if (!$is_logged_in) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TruthWhisper - Anonymous Feedback App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-white">
        <!-- navigation menu start from here -->
        <?php require_once "nav_menu.php"; ?>
        <!-- navigation menu end here -->
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <?php require_once "mobile_menu.php"; ?>
        </div>
        <!-- mobile menu end here -->
    </header>

    <main class="">
        <div class="relative flex min-h-screen overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="./images/beams.jpg" alt=""
                class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div
                class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
            </div>

            <div class="relative max-w-7xl mx-auto">
                <div class="flex justify-end">
                    <span class="block text-gray-600 font-mono border border-gray-400 rounded-xl px-2 py-1">Your
                        feedback form link: <strong><a href="feedback.php">feedback</a></strong></span>
                </div>
                <h1 class="text-xl text-indigo-800 text-bold my-10">Received feedback</h1>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div
                        class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen
                                book. It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>

                    <div
                        class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500">But I must explain to you how all this mistaken idea of denouncing
                                pleasure and praising pain was born and I will give you a complete account of the
                                system, and expound the actual teachings of the great explorer of the truth, the
                                master-builder of human happiness.</p>
                        </div>
                    </div>

                    <div
                        class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
                                dolores eos qui ratione voluptatem sequi nesciunt. </p>
                        </div>
                    </div>

                    <div
                        class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>

                    <!-- feedback print start from here -->
                    <?php
                    $feedbacks = feedback();
                    foreach ($feedbacks as $feedback) {
                        ?>
                        <div
                            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                            <div class="focus:outline-none">
                                <p class="text-gray-500"><?= $feedback['feedback']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- feedback print end here -->
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center justify-center lg:px-8">
            <p class="text-center text-xs leading-5 text-gray-500">&copy; 2024 TruthWhisper, Inc. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>