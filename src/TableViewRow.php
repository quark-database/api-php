<?php

namespace Anafro\QuarkApi;

class TableViewRow
{
    protected array $cells;

    public function __construct(string ...$cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return array
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * @param array $cells
     */
    public function setCells(array $cells): void
    {
        $this->cells = $cells;
    }
}