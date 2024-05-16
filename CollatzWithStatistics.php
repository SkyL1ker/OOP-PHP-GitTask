<?php
require_once 'collatz.php';

class CollatzWithStatistics extends Collatz
{
    private $histogram;
    private $sequences;
    protected $startNumber;
    protected $finishNumber;

    public function __construct($start, $finish)
    {
        $this->startNumber = $start;
        $this->finishNumber = $finish;
        $this->histogram = [];
        $this->sequences = $this->getSequences($this->startNumber, $this->finishNumber);
    }

    public function getHistogram()
    {
        foreach ($this->sequences as $sequence) {
            $iterations = count($sequence) - 1; 
            if (!isset($this->histogram[$iterations])) {
                $this->histogram[$iterations] = 0;
            }
            $this->histogram[$iterations]++;
        }

        return $this->histogram;
    }
}
?>
