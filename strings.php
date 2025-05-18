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
                    $results[] = mb_strtoupper($sentence, 'UTF-8');
                    break;
                case 'lowercase':
                    $results[] = mb_strtolower($sentence, 'UTF-8');
                    break;
                case 'first_upper':
                    $results[] = mb_strtoupper(mb_substr($sentence, 0, 1, 'UTF-8'), 'UTF-8') .
                                 mb_substr($sentence, 1, null, 'UTF-8');
                    break;
                case 'words_upper':
                    $results[] = mb_convert_case($sentence, MB_CASE_TITLE, 'UTF-8');
                    break;
                default:
                    $errors[] = "Invalid operation: $operation";
            }
        }
    }
}

echo !empty($errors) ? implode("\n", $errors) : implode("\n", $results); 
?>