<?php
declare(strict_types=1);

require 'db.php';
class Calculator
{
    private array $marks;
    private int $total;
    private float $percentage;

    public function __construct(array $marks)
    {
        $this->marks = $marks;
    }
    public function calculate(): void
    {
        $this->total = array_sum($this->marks);
        $this->percentage = ($this->total / (count($this->marks) * 100)) * 100;
    }
    public function getTotal(): int
    {
        return $this->total;
    }
    public function getPercentage(): float
    {
        return $this->percentage;
    }
}
