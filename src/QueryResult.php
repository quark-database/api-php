<?php

namespace Anafro\QuarkApi;

class QueryResult
{
    protected QueryExecutionStatus $executionStatus;
    protected ?string $exception;
    protected string $message;
    protected int $time;
    protected ?TableView $tableView;

    /**
     * @throws InstructionResultFormatException
     */
    public function __construct(string $resultInJson)
    {
        $result = json_decode($resultInJson);

        if(!isset($result->status)) {
            throw new InstructionResultFormatException("Required 'status' field in instruction result is missed");
        }

        if(!isset($result->message)) {
            throw new InstructionResultFormatException("Required 'message' field in instruction result is missed");
        }

        if(isset($result->exception)) {
            $this->exception = $result->exception;
        }

        if(isset($result->time)) {
            $this->time = intval($result->time);
        }

        if(isset($result->table)) {
            $this->tableView = new TableView(
                new TableViewHeader(...$result->table->header),
                ...array_map(function(array $row) {
                    return new TableViewRow(...$row);
                }, $result->table->records)
            );
        }

        $this->message  = $result->message;
        $this->executionStatus = QueryExecutionStatus::byName($result->status);
    }

    public function hasTable(): bool
    {
        return isset($this->tableView) && count($this->tableView->getRows()) !== 0;
    }

    public function hasException(): bool
    {
        return isset($this->exception) && strlen($this->exception) !== 0;
    }

    /**
     * @return QueryExecutionStatus
     */
    public function getExecutionStatus(): QueryExecutionStatus
    {
        return $this->executionStatus;
    }

    /**
     * @param QueryExecutionStatus $executionStatus
     */
    public function setExecutionStatus(QueryExecutionStatus $executionStatus): void
    {
        $this->executionStatus = $executionStatus;
    }

    /**
     * @return string|null
     */
    public function getException(): ?string
    {
        return $this->exception;
    }

    /**
     * @param string|null $exception
     */
    public function setException(?string $exception): void
    {
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @return TableView|null
     */
    public function getTableView(): ?TableView
    {
        return $this->tableView;
    }

    /**
     * @param TableView|null $tableView
     */
    public function setTableView(?TableView $tableView): void
    {
        $this->tableView = $tableView;
    }
}