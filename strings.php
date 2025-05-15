<?php
header('Content-Type: text/plain; charset=UTF-8');

$results = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['sentence'], $_POST['operation'])) {
    $errors[] = "Invalid request or missing parameters.";
} else {
    $sentence = trim($_POST['sentence']);
    $operation = $_POST['operation'];

    if (empty($sentence)) {
        $errors[] = "Please enter a valid sentence.";
    } else {
        switch ($operation) {
            case 'uppercase':
                $results[] = "Uppercase: " . strtoupper($sentence);
                break;
            case 'lowercase':
                $results[] = "Lowercase: " . strtolower($sentence);
                break;
            case 'first_upper':
                $results[] = "First Character Uppercase: " . ucfirst(strtolower($sentence));
                break;
            case 'words_upper':
                $results[] = "First Character of Each Word Uppercase: " . ucwords(strtolower($sentence));
                break;
            case 'all':
                $results[] = "Uppercase: " . strtoupper($sentence);
                $results[] = "Lowercase: " . strtolower($sentence);
                $results[] = "First Character Uppercase: " . ucfirst(strtolower($sentence));
                $results[] = "First Character of Each Word Uppercase: " . ucwords(strtolower($sentence));
                break;
            default:
                $errors[] = "Invalid operation selected.";
        }
    }
}

echo !empty($errors) ? implode("\n", $errors) : implode("\n", $results);
?>