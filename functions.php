<?php
function escape($string): string
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}