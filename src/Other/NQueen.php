<?php

/**
 * NQueen Algorithm
 *
 * @author   Arvin Atri  <atriarvin1@gmail.com>
 * @date     2023/12/06
 * @license  MIT
 */
/*
|--------------------------------------------------------------------------
| NQueen Algorithm
|--------------------------------------------------------------------------
|
| Arrange N queens on an NxN chessboard without attacking each other diagonally,
| horizontally, or vertically—a classic problem in combinatorial optimization and
| recursion.
|
*/

class NQueen
{

    //Variable to store the dimensions of the chessboard
    protected int $n;

    //Chessboard represented as an array
    protected array $board;

    //Constructor to initialize the chessboard dimensions and fill it with zeros
    public function __construct(int $n)
    {
        $this->n = $n;
        $this->board = array_fill(0, $this->n, array_fill(0, $this->n, 0));
    }

    public function solve_n_queen($col = 0): void
    {
        if ($col >= $this->n) {
            $this->print_result();
        }

        //Iterating through each row in the current column
        for ($row = 0; $row < $this->n; $row++) {
            if ($this->move_is_promising($row, $col)) {
                //Placing the queen at the current position
                $this->board[$row][$col] = 1;
                //Recursively solving for the next column
                $this->solve_n_queen($col + 1);
                //Backtracking by removing the queen from the current position
                $this->board[$row][$col] = 0;
            }
        }
    }

    public function move_is_promising($row, $col): bool
    {
        //Checking if there is no queen in the same row
        for ($index = 0; $index < $col; $index++)
            if ($this->board[$row][$index])
                return false;

        //Checking if there is no queen on the upper-left diagonal
        for ($i = $row, $j = $col; $i >= 0 && $j >= 0; $i--, $j--)
            if ($this->board[$i][$j])
                return false;

        //Checking if there is no queen on the lower-left diagonal
        for ($i = $row, $j = $col; $i < $this->n && $j >= 0; $i++, $j--)
            if ($this->board[$i][$j])
                return false;

        //If no conflicts are found, the move is promising
        return true;
    }

    public function print_result(): void
    {
        for ($i = 0; $i < $this->n; $i++) {
            for ($j = 0; $j < $this->n; $j++)
                echo $this->board[$i][$j];
            echo "\n";
        }
        echo "\n";
    }
}

$dimensions = 4;
(new NQueen($dimensions))->solve_n_queen();
