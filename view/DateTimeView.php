<?php

class DateTimeView {


	public function show() {
		$timeString = date("l jS \\of F Y - H:i:s ");

		return '<p>' . $timeString . '</p>';
	}
}