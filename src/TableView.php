<?php

namespace Anafro\QuarkApi;

class TableView
{
    protected TableViewHeader $header;
    protected array $rows;

    public function __construct(TableViewHeader $header, TableViewRow ...$rows)
    {
        $this->header = $header;
        $this->rows = $rows;
    }

    /**
     * @return TableViewHeader
     */
    public function getHeader(): TableViewHeader
    {
        return $this->header;
    }

    /**
     * @param TableViewHeader $header
     */
    public function setHeader(TableViewHeader $header): void
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }
}