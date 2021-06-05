<?php

/**
 * Provide utils functions to use with dates.
 * Class FormUtils
 */
class DateUtils {

    /**
     * Check if a date is PHP valid.
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function isDateValid(string $date, string $format='Y-m-d'): bool {
        try {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }
        catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check is a date is between date1 and date 2.
     * @param string $date
     * @param string|null $lowerDate
     * @param string|null $upperDate
     * @param string $format
     * @return bool
     */
    public static function isDateBetween(string $date, string $lowerDate=null, string $upperDate=null, string $format='Y-m-d'): bool {

        try {
            $date = DateTime::createFromFormat($format, $date);

            // If lower date is null, using global app date low threshold.
            if(is_null($lowerDate)) {
                $lowerDate = (new DateTime())->modify('-110 years');
            }
            else {
                $lowerDate = DateTime::createFromFormat($format, $lowerDate);
            }

            // Same for max date threshold.
            if(is_null($upperDate)) {
                $upperDate = (new DateTime())->modify('-10 years');
            }
            else {
                $upperDate = DateTime::createFromFormat($format, $upperDate);
            }


            return $date >= $lowerDate && $date <= $upperDate;
        }
        catch (Exception $e) {
            return false;
        }
    }

}