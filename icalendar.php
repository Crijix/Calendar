<?php

class Calendar
{
	private $month;
	private $year;

	public function __construct ($month, $year, $days_of_week = array('sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø'))
	{
		$this->month = $month;
		$this->year = $year;
		$num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		$date_info = getdate(strtotime('first day', mktime(0,0,0,$this->month,1,$this->year)));
		$days_of_week = $date_info['wday'];
	}

	public function showCalendar() {

		$output = '<table class = "year">';
		$output .= '<caption>' . $date_info['month'] . ' ' . $this->year . '</caption>';

		echo $output;
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>iCalendar</title>
	<link rel="stylesheet" type="text/css" href="calendar.css">
</head>
<body>
<?php
	$calendar = new Calendar(3, 2018);
	$calendar->showCalendar();
?>
</body>
</html>
		$nextYear = $this->nyear;
		$nextMonth = $this->nmonth +1;

		if ($nextMonth > 12) {
			$nextYear++;
			$nextMonth = 1;
		}
		$next = getdate(strtotime("Y-m", mktime(0, 0, 0, $this->month, +1, $this->year)));

		$output .= '<a href="?ym= <?php echo $prev ?>">&lt;</a>';


		$prevYear = $this->nyear;
		$prevMonth = $this->nmonth - 1;

		if ($prevMonth <= 0) {
			$prevYear--;
			$prevMonth = 12; // December
		}