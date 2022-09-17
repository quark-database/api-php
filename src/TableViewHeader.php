<?php

namespace Anafro\QuarkApi;

class TableViewHeader
{
    protected array $columnNames;

    public function __construct(string ...$columnNames)
    {
        $this->columnNames = $columnNames;
    }

    /**
     * @return array
     */
    public function getColumnNames(): array
    {
        return $this->columnNames;
    }

    /**
     * @param array $columnNames
     */
    public function setColumnNames(array $columnNames): void
    {
        $this->columnNames = $columnNames;
    }
}