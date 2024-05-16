<?php

class Collatz
{
    private function collatzSequence($n)
    {
        $sequence = [$n];
        while ($n != 1) {
            if ($n % 2 == 0) {
                $n = $n / 2;
            } else {
                $n = 3 * $n + 1;
            }
            $sequence[] = $n;
        }
        return $sequence;
    }

    public function getSequences($start, $finish)
    {
        $sequences = [];
        for ($i = $start; $i <= $finish; $i++) {
            $sequences[$i] = $this->collatzSequence($i);
        }
        asort($sequences);
        return $sequences;
    }
}
?>
