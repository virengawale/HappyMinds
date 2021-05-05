<?php
ini_set('error_reporting', E_ALL);
require_once __DIR__ . '/CalculatorInterface.php';

/**
 * Class RPNCalculator
 */
class RPNCalculator implements Calculator
{
    /** const OPERATORS array */
    const OPERATORS = ['+', '-', '*', '/'];
    private $stack = [];

    /**
     * Calculator
     */
    public function calculator(): void
    {
        echo "\nWelcome to RPN Calculator\n";
        while ($input = trim(fgets(STDIN))) {
           
            if (in_array($input, self::OPERATORS, true)) {
           
                if (!$this->checkOperandExistForOperation()) {
                    echo "\nFor operation minimum 2 operand is required\n";
                    continue;
                }
           
                $operandTwo = array_pop($this->stack);
                $operandOne = array_pop($this->stack);
                $result = $this->findResult($input, $operandOne, $operandTwo);
                array_push($this->stack, $result);
                echo "\n$operandOne $input $operandTwo = $result\n\n";

                continue;
            }
           
            if (!is_numeric($input)) {
                echo "\nEnter integer only\n\n";

                continue;
            }

            array_push($this->stack, $input);
        }
    }

    /**
     * Check operand exist for operation
     *
     * @return bool
     */
    private function checkOperandExistForOperation(): bool
    {
        if (count($this->stack) > 1) {
            return true;
        }

        return false;
    }

    /**
     * Find Result
     *
     * @param $operator string
     * @param $operandOne float
     * @param $operandTwo float
     * @return float
     */
    private function findResult(string $operator, float $operandOne, float $operandTwo): float
    {
        switch ($operator) {
            case '+':
                $result = $this->addition($operandOne, $operandTwo, $operator);
                break;
            case '-':
                $result = $this->subtraction($operandOne, $operandTwo, $operator);
                break;
            case '*':
                $result = $this->multiplication($operandOne, $operandTwo, $operator);
                break;
            case '/':
                $result = $this->division($operandOne, $operandTwo, $operator);
                break;
        }

        return round($result, 2);
    }

    /**
     * Addition
     *
     * @param $operandOne float
     * @param $operandTwo float
     * @return float
     */
    private function addition(float $operandOne, float $operandTwo): float
    {
        return $operandOne + $operandTwo;
    }

    /**
     * Subtraction
     *
     * @param $operandOne float
     * @param $operandTwo float
     * @return float
     */

    private function subtraction(float $operandOne, float $operandTwo): float
    {
        return $operandOne - $operandTwo;
    }

    /**
     * Division
     *
     * @param $operandOne float
     * @param $operandTwo float
     * @return float
     */
    private function division(float $operandOne, float $operandTwo): float
    {
        return $operandOne / $operandTwo;
    }

    /**
     * Multiplication
     *
     * @param $operandOne float
     * @param $operandTwo float
     * @return float
     */
    private function multiplication(float $operandOne, float $operandTwo): float
    {
        return $operandOne * $operandTwo;
    }
}

$rpnCalculatorObj = new RPNCalculator();
$rpnCalculatorObj->calculator();
