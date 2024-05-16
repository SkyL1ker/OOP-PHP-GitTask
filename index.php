<?php
require_once 'CollatzWithStatistics.php';

$start = isset($_POST["start"]) ? $_POST["start"] : null;
$finish = isset($_POST["finish"]) ? $_POST["finish"] : null;

$histogram = [];
$sequences = [];
if ($start !== null && $finish !== null) {
    $collatzWithStatistics = new CollatzWithStatistics($start, $finish);
    $histogram = $collatzWithStatistics->getHistogram();
    $sequences = $collatzWithStatistics->getSequences($start, $finish);

    // usort($sequences, function ($a, $b) {
    //     return count($a) - count($b);
    // });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Function Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Collatz Function Calculator</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Start Number: <input type="number" name="start" min="1" value="<?php echo $start ?? ''; ?>"><br>
        Finish Number: <input type="number" name="finish" min="1" value="<?php echo $finish ?? ''; ?>"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <div class="result">
        <?php
        if (!empty($sequences)) {
            echo "<h2>Collatz Function Iteration Results</h2>";
            foreach ($sequences as $number => $sequence) {
                echo "<div class='tree'>";
                foreach ($sequence as $value) {
                    echo "<div class='arrow'></div>";
                    echo "<div class='node'>$value</div>";
                    echo "<div class='arrow'></div>";
                }
                echo "</div>";
            }
        }
        // Display histogram
        if (!empty($histogram)) {
            asort($histogram);
            echo "<h2>Collatz Function Iteration Histogram</h2>";
            echo "<div class='histogram'>";
            foreach ($histogram as $iterations => $frequency) {
                echo "<div class='bar'>";
                echo "<label>$iterations</label>";
                echo "<div class='fill' style='width: " . ($frequency * 15) . "px'></div>";
                echo "<span>$frequency</span>";
                echo "</div>";
            }
            echo "</div>";
        }

        ?>
    </div>
</body>

</html>