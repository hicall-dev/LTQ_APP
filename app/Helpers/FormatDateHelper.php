<?php

if (! function_exists('formatDateTime')) {
    function formatDateTime($dateTime, $format = 'd/m/Y H:i')
    {
        return $dateTime ? \Carbon\Carbon::parse($dateTime)->format($format) : null;
    }
}
