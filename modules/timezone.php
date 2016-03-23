<?php

namespace Roots\Sage\TZ;
//NOT WORKING FOR NOW
Class Timezone{
	public $timezoneList;

	function __construct(){
		$this->timezoneList = array();
	}

	function get_timezone_array(){
		$timezoneIdentifiers = DateTimeZone::listIdentifiers();
		$utcTime = new DateTime('now', new DateTimeZone('UTC'));

		$tempTimezones = array();
		foreach ($timezoneIdentifiers as $timezoneIdentifier) {
			$currentTimezone = new DateTimeZone($timezoneIdentifier);

			$tempTimezones[] = array(
				'offset' => (int)$currentTimezone->getOffset($utcTime),
				'identifier' => $timezoneIdentifier
			);
		}

		// Sort the array by offset,identifier ascending
		usort($tempTimezones, function($a, $b) {
			return ($a['offset'] == $b['offset'])
				? strcmp($a['identifier'], $b['identifier'])
				: $a['offset'] - $b['offset'];
		});

		//$timezoneList = array();
		foreach ($this->timezoneList as $tz) {
			$sign = ($tz['offset'] > 0) ? '+' : '-';
			$offset = gmdate('H:i', abs($tz['offset']));
			$this->timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
				$tz['identifier'];
		}

		return $this->timezoneList;
	}
}