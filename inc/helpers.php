<?php

/**
 * Convert date string to timestamp.
 * @param $date_string
 * @return string
 */
function to_timestamp($date_string): string
{
    return strtotime($date_string);
}

/**
 * Convert timestamp to date string.
 * @param $timestamp
 * @return string
 */
function timestamp_to_date($timestamp): string
{
    if ($timestamp > 0) {
        return date('Y-m-d', (int) $timestamp);
    }

    return '';
}

/**
 * Convert timestamp to viewable date string.
 * @param $timestamp
 * @return string
 */
function timestamp_to_viewable_date($timestamp): string
{
    if ($timestamp > 0) {
        return date('d M Y H:i', (int) $timestamp);
    }

    return 'No data.';
}