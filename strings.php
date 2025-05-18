<?php
header('Content-Type: text/plain; charset=UTF-8');


if (!extension_loaded('mbstring')) {
    die('mbstring extension is required.');
}

$results = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['sentence'], $_POST['operation'])) {
    $errors[] = "Invalid request or missing parameters.";
} else {
    // Sanitize input: trim and ensure valid UTF-8
    $sentence = trim($_POST['sentence']);
    if (!mb_check_encoding($sentence, 'UTF-8')) {
        $errors[] = "Invalid UTF-8 encoding in sentence.";
    } else {
        $operation = $_POST['operation'];

        if (empty($sentence)) {
            $errors[] = "Please enter a valid sentence.";
        } else {
            switch ($operation) {
                case 'uppercase':
                    $results[] = "Uppercase: " . mb_strtoupper($sentence, 'UTF-8');
                    break;
                case 'lowercase':
                    $results[] = "Lowercase: " . mb_strtolower($sentence, 'UTF-8');
                    break;
                case 'first_upper':
                    // Only change the first character to uppercase, preserve rest
                    $results[] = "First Character Uppercase: " .
                        mb_strtoupper(mb_substr($sentence, 0, 1, 'UTF-8'), 'UTF-8') .
                        mb_substr($sentence, 1, null, 'UTF-8');
                    break;
                case 'words_upper':
                    $results[] = "First Character of Each Word Uppercase: " .
                        mb_convert_case($sentence, MB_CASE_TITLE, 'UTF-8');
                    break;
                case 'all':
                    $results[] = "Uppercase: " . mb_strtoupper($sentence, 'UTF-8');
                    $results[] = "Lowercase: " . mb_strtolower($sentence, 'UTF-8');
                    $results[] = "First Character Uppercase: " .
                        mb_strtoupper(mb_substr($sentence, 0, 1, 'UTF-8'), 'UTF-8') .
                        mb_substr($sentence, 1, null, 'UTF-8');
                    $results[] = "First Character of Each Word Uppercase: " .
                        mb_convert_case($sentence, MB_CASE_TITLE, 'UTF-8');
                    break;
                default:
                    $errors[] = "Invalid operation selected.";
            }
        }
    }
}

echo !empty($errors) ? implode("\n", $errors) : implode("\n", $results);
