<nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
        <a href="./index.php" class="-m-1.5 p-1.5">
            <span class="sr-only">TrueUser</span>
            <span
                class="block font-bold text-lg bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TrueUser
                Logo</span>
        </a>
    </div>
    <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <span class="text-sm font-semibold leading-6 text-gray-900">Welcome,
            <?php echo !empty($is_logged_in) ? htmlspecialchars($_SESSION['user_name']) : 'Guest User'; ?>
            !</span>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <div class="space-x-4">
            <a href="./feedback.php" class="text-sm font-semibold leading-6 text-green-600">Feedback</a>
            <?php if (empty($is_logged_in)): ?>
                <a href="./login.php" class="text-sm font-semibold leading-6 text-gray-900">Log in <span
                        aria-hidden="true">&rarr;</span></a>
            <?php else: ?>
                <a href="./logout.php" class="text-sm font-semibold leading-6 text-green-600">Log out</a>
            <?php endif; ?>
        </div>
    </div>
</nav>