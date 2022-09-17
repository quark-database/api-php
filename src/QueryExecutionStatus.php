<?php

namespace Anafro\QuarkApi;

enum QueryExecutionStatus: int
{
    case OK = 0;
    case SYNTAX_ERROR = 1;
    case SERVER_ERROR = 2;
    case MIDDLEWARE_ERROR = 3;

    public static function byName(string $statusName, ?QueryExecutionStatus $defaultValue = null): ?QueryExecutionStatus
    {
        foreach(self::cases() as $status) {
            if($statusName === $status->name) {
                return $status;
            }
        }

        return $defaultValue;
    }
}