<?php
header('Content-Type: text/plain'); // For AJAX compatibility, plain text output



// Initialize variables
$results = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['num1'], $_POST['num2'], $_POST['num3'], $_POST['num4'], $_POST['operation'])) {
    // Validate inputs
    $num1 = filter_var($_POST['num1'], FILTER_VALIDATE_FLOAT);
    $num2 = filter_var($_POST['num2'], FILTER_VALIDATE_FLOAT);
    $num3 = filter_var($_POST['num3'], FILTER_VALIDATE_FLOAT);
    $num4 = filter_var($_POST['num4'], FILTER_VALIDATE_FLOAT);
    $operation = $_POST['operation'];

    if ($num1 === false || $num2 === false || $num3 === false || $num4 === false) {
        $errors[] = "All inputs must be valid numbers.";
    } else {
        // Perform operations based on selection
        switch ($operation) {
            case 'add':
                $results[] = "Addition: " . ($num1 + $num2 + $num3 + $num4);
                break;
            case 'subtract':
                $results[] = "Subtraction: " . ($num1 - $num2 - $num3 - $num4);
                break;
            case 'multiply':
                $results[] = "Multiplication: " . ($num1 * $num2 * $num3 * $num4);
                break;
            case 'divide':
                if ($num2 != 0 && $num3 != 0 && $num4 != 0) {
                    $results[] = "Division: " . ($num1 / $num2 / $num3 / $num4);
                } else {
                    $results[] = "Division: Cannot divide by zero";
                }
                break;
            case 'combine':
                $results[] = "Combination: " . ((($num1 + $num2) * $num3) / ($num4 != 0 ? $num4 : 1));
                break;
            case 'all':
                $results[] = "Addition: " . ($num1 + $num2 + $num3 + $num4);
                $results[] = "Subtraction: " . ($num1 - $num2 - $num3 - $num4);
                $results[] = "Multiplication: " . ($num1 * $num2 * $num3 * $num4);
                if ($num2 != 0 && $num3 != 0 && $num4 != 0) {
                    $results[] = "Division: " . ($num1 / $num2 / $num3 / $num4);
                } else {
                    $results[] = "Division: Cannot divide by zero";
                }
                $results[] = "Combination: " . ((($num1 + $num2) * $num3) / ($num4 != 0 ? $num4 : 1));
                break;
            default:
                $errors[] = "Invalid operation selected.";
        }
    }
}

// Output errors or results
if (!empty($errors)) {
    echo implode("\n", $errors);
} else {
    echo implode("\n", $results);
} ?>
