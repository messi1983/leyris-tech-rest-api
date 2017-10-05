<?php
namespace AppBundle\Outils;
use AppBundle\Constants\Constants;

/**
 * Dates utils class
 */
class DateOutils
{	
	/**
	 * Replace hours, minutes and seconds of a given dateTime.
	 * 
	 * @param unknown $datetime
	 * @param unknown $hours
	 * @param unknown $minutes
	 * @param unknown $seconds
	 * @return new Datetime with hours, minutes and seconds specified
	 */
	public static function replaceHourMinuteSecondOfDateTime($datetime, $hours, $minutes, $seconds)
	{
		$dateMinInStr = $datetime->format(Constants::DEFAULT_DATE_FORMAT);
		return \DateTime::createFromFormat(Constants::DATE_TIME_FORMAT, $dateMinInStr.' '.$hours.':'.$minutes.':'.$seconds);
	}
	
}
?>
