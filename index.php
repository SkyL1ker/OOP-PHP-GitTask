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
        Start Number: <input type="number" name="start" min="0"><br>
        Finish Number: <input type="number" name="finish" min="0"><br>
        <input type="submit" name="submit" value="Submit" min="0">
    </form>
    <div class="result">
        <?php
        include 'colatz.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start = $_POST["start"];
            $finish = $_POST["finish"];
            $result = [];

            for ($i = $start; $i <= $finish; $i++) {
                $result[$i] = collatz($i);
            }

            // Sort results based on number of iterations
            asort($result);

            foreach ($result as $number => $iterations) {
                echo "<div class='tree'>";
                echo "<div class='node'>$number</div>";
                $n = $number;
                while ($n != 1) {
                    if ($n % 2 == 0) {
                        $n = $n / 2;
                    } else {
                        $n = 3 * $n + 1;
                    }
                    echo "<div class='arrow'></div>";
                    echo "<div class='node'>$n</div>";
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</body>

</html>
