<?php

namespace Anafro\QuarkApi;

function bufferToInt32(array|string $buffer)
{
    return ($buffer[3] << 24) + ($buffer[2] << 16) + ($buffer[1] << 8) + $buffer[0];
}