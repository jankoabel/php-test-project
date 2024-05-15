<?php
/**
 * Algorithmic Warm-up:
 * This script iterates through integers from 1 to 100 and prints specific strings based on divisibility.
 *
 * @param int $start The starting integer for iteration.
 * @param int $end The ending integer for iteration.
 * @return void
 */
function printNumbers($start = 1, $end = 16) {
    // Check if input parameters are valid
    if (!is_int($start) || !is_int($end) || $start < 1 || $end < $start) {
        echo "Invalid input parameters. Please provide valid integers.\n";
        return;
    }

    // Iterate through the range of numbers
    for ($i = $start; $i <= $end; $i++) {
        // Check divisibility and print accordingly
        if ($i % 15 == 0) {
            echo "SuperFaktura\n";
            continue;
        }
        if ($i % 3 == 0) {
            echo "Super\n";
            continue;
        }
        if ($i % 5 == 0) {
            echo "Faktura\n";
            continue;
        }
        echo $i . "\n";
    }
}

// Test the function with default parameters
printNumbers();
?>
