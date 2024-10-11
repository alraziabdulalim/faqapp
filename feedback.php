<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);

require "helpers.php";

$errors = [];
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$is_logged_in) {

        if (empty($_POST['name'])) {
            $errors['name'] = 'Please provide a name.';
        } else {
            $name = sanitize($_POST['name']);
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Please provide an email address';
        } else {
            $email = sanitize($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please provide a valid email address';
            }
        }
    }

    if (empty($_POST['feedback'])) {
        $errors['feedback'] = 'Please provide feedback.';
    } else {
        $feedback = sanitize($_POST['feedback']);
    }

    if (empty($errors)) {

        if ($is_logged_in) {
            createFeedback($is_logged_in, $feedback);
        } else {
            guestUser($name, $email, $feedback);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrueUser - Anonymous Feedback App</title>
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
        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="./images/beams.jpg" alt=""
                class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div
                class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
            </div>
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
                <div class="mx-auto max-w-xl">
                    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                        <div class="mx-auto w-full max-w-xl text-center">
                            <h1
                                class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">
                                TrueUser</h1>
                            <h3 class="text-gray-500 my-2">Want to ask something or share a feedback to "John Doe"?</h3>
                        </div>

                        <div class="mt-10 mx-auto w-full max-w-xl">
                            <?php if (!empty($errors)): ?>
                                <div class="mb-4 text-red-600">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo htmlspecialchars($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form class="space-y-6" action="feedback.php" method="POST">
                                <div>
                                    <label for="feedback"
                                        class="block text-sm font-medium leading-6 text-gray-900">Don't hesitate, just
                                        do it!</label>
                                </div>

                                <?php if (empty($is_logged_in)): ?>
                                    <div>
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                        <div class="mt-2">
                                            <input id="name" name="name" type="text" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                            address</label>
                                        <div class="mt-2">
                                            <input id="email" name="email" type="email" autocomplete="email" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <div class="mt-2">
                                        <textarea required name="feedback" id="feedback" cols="30" rows="10"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center justify-center lg:px-8">
            <p class="text-center text-xs leading-5 text-gray-500">&copy; 2024 TrueUser, Inc. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>