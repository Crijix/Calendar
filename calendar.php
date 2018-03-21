<?php

/**
* Calendar
*/
class Calendar
{
	private $month;
	private $year;
	private $days_of_week;
	private $date_info;
	private $day_of_week;
	private $num_days;
	private $nmonth;
	private $nyear;

	private 

	public function __construct( $month, $year, $days_of_week = array('sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø'))
	{
		$this->month = $month;
		$this->year = $year;
		$this->days_of_week = $days_of_week;
		// How many days there are in that month
		$this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		$this->date_info = getdate(strtotime('first day of', mktime(0,0,0,$this->month,1,$this->year)));
		$this->day_of_week = $this->date_info['wday'];
		$this->nmonth = date("m", strtotime($this->date_info['month']));
		$this->nyear = date("y", strtotime($this->date_info['year']));

		// Get prev and next month
		if (isset($_GET['ym'])) {
			$ym = $_GET['ym'];
		} else {
			$ym = date("m",time());
		}

		// Get prev and next year
		if (isset($_GET['my'])) {
			$my = $_GET['my'];
		} else {
			$my = date("Y",time());
		}

		
	}

	public function show() {

		// Display month and year
		$output = '<table class="year">';
		$output .= '<caption class="topHeader">' . $this->date_info['month'] . ' ' . $this->year . '</caption>';
		//$output .= '<caption>' . $this->nyear . '</caption>';
		$output .= '<tr>';

		// Days of the week
		foreach ($this->days_of_week as $day) {
			$output .= '<td class="header">' . $day . '</th>';
		}

		$output .= '</tr><tr>';

		// Add blank space if the day of week is not sø
		if ($this->day_of_week > 0) {
			$output .= '<td colspan="' . $this->day_of_week . '"></td>';
		}

		$current_day = 1;

		// Building the calendar by looping through day_of_week
		while ($current_day <= $this->num_days) {
			// If day of week is 7 then start a new row
			if ($this->day_of_week == 7) {
				$this->day_of_week = 0;
				$output .= '</tr><tr>';
			}

			// Check to see if it is the current day and month
			if ($current_day == date("d") && $this->nmonth == date("m")) {
				// Add border around the current day
				$output .= '<td class="day currentDay">' . $current_day . '</td>';
			} else {
				// Prints out regardless of the current day and month
				$output .= '<td class="day">' . $current_day . '</td>';
			}

			$current_day++;
			$this->day_of_week++;
		}

		// If day of week doesn't end at sø, then add blank space
		if ($this->day_of_week < 8) {
			for ($i = 1; $i <= (8 - $this->day_of_week); $i++) {
				//$output .= '<td colspan="' . '' . '"></td>';
			}
		}

		$output .= '</tr>';
		$output .= '</table>';

		echo $output;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
	<link href="calender.css" rel="stylesheet">
</head>
<body>
<?php
	//$month = date("m");
	//$year = date("Y");
	$calendar = new Calendar(3, 2018);
	$calendar->show();

	// Testing ICS file

	//include ( 'iCal.php' ); 
	//$ical = new iCalReader(); 
	//$lines = $ical->load( file_get_contents( 'Testlabvagt.ics' ) );

	//error_reporting(E_ALL & ~E_NOTICE);
	//error_reporting(0);

	//$lastElement = end($lines);

	//for ($i = 0; $i < 800; $i++) {

	//	echo $lines['VEVENT'][$i]['LOCATION'];
	//	echo "<br>";
	//	echo $lines ['VEVENT'][$i]['SUMMARY']['value'];
	//	echo "<br>";
	//}
	//echo $lastElement;
?>
</body>
</html>