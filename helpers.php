<?php

function sanitize(string $data): string
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function dd(mixed $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

function flash($type, $message)
{
    // Assuming a flash function to store messages in session
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['flash'][$type] = $message;
}

function createUser($name, $email, $password)
{
    $id = str_replace('.', '', microtime(true));
    $params = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ];

    // Form data to JSON
    $jsonContent = json_encode($params);
    $filePath = './datastore/users.txt';

    // Open the file in append mode, create it if it doesn't exist
    $file = fopen($filePath, 'a');

    if ($file) {
        fwrite($file, $jsonContent . "\n");
        fclose($file);
        flash('success', 'You have successfully registered. Please log in to continue');

        header('Location: login.php');
        exit;
    } else {
        global $errors;
        $errors['auth_error'] = 'An error occurred. Please try again';
    }
}

function guestUser($name, $email, $feedback)
{
    $id = str_replace('.', '', microtime(true));
    $params = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => '',
    ];

    // Form data to JSON
    $jsonContent = json_encode($params);
    $filePath = './datastore/users.txt';

    // Open the file in append mode, create it if it doesn't exist
    $file = fopen($filePath, 'a');

    if ($file) {
        fwrite($file, $jsonContent . "\n");
        fclose($file);
        createFeedback($id, $feedback);
        exit;
    } else {
        global $errors;
        $errors['auth_error'] = 'An error occurred. Please try again';
    }
}

function findUserByEmail($email, $password)
{
    $filePath = './datastore/users.txt';

    // Read the file content
    $fileContent = file_get_contents($filePath);

    // Split the content by new lines to get individual JSON objects
    $usersArray = explode("\n", trim($fileContent));

    // Convert each JSON object to an associative array
    $users = array_map(function ($user) {
        return json_decode($user, true);
    }, $usersArray);

    verifyEmail($email, $password, $users);
}

function verifyEmail($email, $password, $users)
{
    // find user by email
    foreach ($users as $user) {
        if ($user['email'] === $email) {

            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Set session variable
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    // Redirect to dashboard
                    header('Location: dashboard.php');
                    exit;
                } else {
                    // Invalid password
                    $errors['auth_error'] = 'Invalid password';
                }
            } else {
                // User not found
                $errors['auth_error'] = 'Invalid Email.';
            }
        }
    }

    if (isset($errors['auth_error'])) {
        // Display error message
        echo $errors['auth_error'];
    }
}

function createFeedback($user_id, $feedback)
{
    $params = [
        'user_id' => $user_id,
        'feedback' => $feedback,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    // Form data to JSON
    $jsonContent = json_encode($params);
    $filePath = './datastore/feedback.txt';

    // Open the file in append mode, create it if it doesn't exist
    $file = fopen($filePath, 'a');

    if ($file) {
        fwrite($file, $jsonContent . "\n");
        fclose($file);
        flash('success', 'Thanks for your valuable feedback.');

        header('Location: feedback-success.php');
        exit;
    } else {
        global $errors;
        $errors['auth_error'] = 'An error occurred. Please try again';
    }
}

function feedback()
{
    $filePath = './datastore/feedback.txt';

    // Read the file content
    $fileContent = file_get_contents($filePath);

    // Split the content by new lines to get individual JSON objects
    $feedbackArray = explode("\n", trim($fileContent));

    // Convert each JSON object to an associative array
    $feedbacks = array_map(function ($user) {
        return json_decode($user, true);
    }, $feedbackArray);

    return $feedbacks;
}