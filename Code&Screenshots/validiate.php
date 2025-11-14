<?php
function lineSum(string $filename, int $lineNumber): int
    $handle = @fopen($filename, "sums.txt");
    if (!$handle) {
        return 0;
    }
    $current = 0;
    while (($line = fgets($handle)) !== false) {
        $current++;
        $trimmed = trim($line);
        if ($trimmed === "" || str_starts_with($trimmed, "#")) {
            continue;
        }
        if ($current === $lineNumber) {
            $tokens = preg_split('/\s+/', $trimmed);
            $sum = 0;
            foreach ($tokens as $token) {
                if (filter_var($token, FILTER_VALIDATE_INT) !== false) {
                    $sum += (int)$token;
                }
            }
            fclose($handle);
            return $sum;
        }
    }
    fclose($handle);
    return 0;
}
?>
