<style>
	body {
		font-family: sans-serif !important;
	}

	.none {
		display: none;
	}

	#calender_section {
		width: 100%;
	}

	#calender_section_top {
		width: 100%;
		float: left;
		margin-top: 20px;
	}

	#calender_section_top ul {
		padding: 0;
		list-style-type: none;
	}

	#calender_section_top ul li {
		float: left;
		display: block;
		width: 99px;
		border-right: 1px solid #fff;
		text-align: center;
		font-size: 14px;
		min-height: 0;
		background: none;
		box-shadow: none;
		margin: 0;
		padding: 0;
	}

	#calender_section_bot {
		width: 100%;
		margin-top: 20px;
	}

	#calender_section_bot ul {
		margin: 0;
		padding: 0;
		list-style-type: none;
	}

	#calender_section_bot ul li {
		float: left;
		width: 100px;
		height: 85px;
		text-align: left;
		border: 1px solid #cccccc;
		background: none;
		box-shadow: none;
		position: relative;
	}

	/*========== Hover Popup ===============*/
	.date_cell_info_hover .btn-get-events {
		font-size: 12px;
	}

	.date_cell {
		cursor: pointer;
		cursor: hand;
	}

	.date_popup_wrap {
		position: absolute;
		width: 143px;
		height: 115px;
		z-index: 9999;
		top: -115px;
		left: -55px;
		background: transparent url(add-new-event.png) no-repeat top left;
		color: #666 !important;
	}

	.date_window {
		margin-top: 20px;
		margin-bottom: 2px;
		padding: 5px;
		font-size: 16px;
		margin-left: 9px;
		margin-right: 14px;
	}

	.dot {
		height: 25px;
		width: 25px;
		border-radius: 50%;
		display: inline-block;
	}

	.square {
		height: 25px;
		width: 25px;
		display: inline-block;
	}

	.indicators {
		flex-grow: 1;
		flex-basis: 150px;
		margin-bottom: 10px;
	}
</style>
<?php
/*
 * Function requested by Ajax
 */
require_once('config.php');
if (isset($_POST['func']) && !empty($_POST['func'])) {
	switch ($_POST['func']) {
		case 'getCalender':
			getCalendar($_POST['year'], $_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		default:
			break;
	}
}

/*
 * Get calendar full HTML
 */
function getCalendar($year = '', $month = '')
{
	global $conn;
	$dateYear = ($year != '') ? $year : date("Y");
	$dateMonth = ($month != '') ? $month : date("m");
	$date = $dateYear . '-' . $dateMonth . '-01';
	$currentMonthFirstDay = date("N", strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;
?>
	<div class="d-flex flex-column">
		<div id="calender_section">
			<h3 class="text-center mt-3 mb-5">ATV Motoshop Calendar</h3>
			<div class="d-flex justify-content-center flex-wrap mb-3">
				<div class="indicators today-indicator d-flex align-self-center mx-3">
					<span class="dot bg-secondary mr-2 me-2"></span> Date Today
				</div>
				<div class="indicators available-success d-flex align-self-center mx-3">
					<span class="dot bg-success mr-2 me-2"></span> Still Available
				</div>
				<div class="indicators available-success d-flex align-self-center mx-3">
					<span class="dot bg-danger mr-2 me-2"></span> Fully Booked
				</div>
				<div class="indicators closed-indicator d-flex align-self-center mx-3">
					<span class="dot bg-dark mr-2 me-2"></span> Closed
				</div>
				<div class="indicators closed-indicator d-flex align-self-center mx-3">
					<span class="square bg-dark mr-2 me-2"></span> Few slot is unavailable
				</div>
			</div>
			<div class="d-flex justify-content-center mx-5">
				<button class="btn btn-outline-dark" onclick="getCalendarDetails('calendar_div','<?= date('Y', strtotime($date . ' - 1 Month')); ?>','<?php echo date('m', strtotime($date . ' - 1 Month')); ?>');">Prev
				</button>
				<div class="d-flex flex-row w-100 mx-2">
					<select name="month_dropdown" class="mx-1 w-100 month_dropdown form-control"><?php echo getAllMonths($dateMonth); ?>
					</select>
					<select name="year_dropdown" class="mx-1 w-100 year_dropdown form-control"><?php echo getYearList($dateYear); ?>
					</select>
				</div>
				<button class="btn btn-outline-dark" onclick="getCalendarDetails('calendar_div','<?= date('Y', strtotime($date . ' + 1 Month')); ?>','<?php echo date('m', strtotime($date . ' + 1 Month')); ?>');">Next
				</button>
			</div>
			<div class="d-flex flex-column mx-4">
				<div id="calender_section_top">
					<ul>
						<li>Sun</li>
						<li>Mon</li>
						<li>Tue</li>
						<li>Wed</li>
						<li>Thu</li>
						<li>Fri</li>
						<li>Sat</li>
					</ul>
				</div>
				<div id="calender_section_bot">
					<ul>
						<?php
						$dayCount = 1;
						for ($cb = 1; $cb <= $boxDisplay; $cb++) :
							if (($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)) :

								//Current date
								$currentDate = $dateYear . '-' . $dateMonth . '-' . $dayCount;
								$unavailable = $dateYear . '-' . $dateMonth . '-' . $dayCount;
								$eventNum = 0;
								$unavailableTotal = 0;
								$holidayTotal = 0;
								//Include db configuration file
								//Get number of events based on the current date
								$result = $conn->query("SELECT hours FROM appointment WHERE dates = '" . $currentDate . "' AND status = 1 GROUP BY hours");
								$unavailableTime = $conn->query("SELECT * FROM unavailable_dates WHERE schedule = '" . $unavailable . "' and duration > 0");
								$holiday = $conn->query("SELECT * FROM unavailable_dates WHERE schedule = '" . $unavailable . "' and duration < 1");
								$eventNum = $result->num_rows;
								$unavailableTotal = $unavailableTime->num_rows;
								$holidayTotal = $holiday->num_rows;
								// if ($unavailableTotal > 0) {
								// 	$secs = $unavailableData['duration'] * 3600; // duration * secs
								// 	$durationPercentage = $secs / 864; // 86,400 secs / 24hours
								// }
								//Define date cell color
						?>
								<?php if (strtotime($currentDate) == strtotime(date("Y-m-d"))) : ?>
									<li date="<?= $currentDate ?>" class="bg-secondary text-white date_cell">
									<?php elseif ($eventNum >= 1 && $eventNum < 5) : ?>
									<li date="<?= $currentDate ?>" data-total="<?= $eventNum ?>" class="bg-success text-white date_cell">
									<?php elseif ($eventNum === 5) : ?>
									<li date="<?= $currentDate ?>" data-total="<?= $eventNum ?>" class="bg-danger text-white date_cell">
									<?php elseif ($unavailableTotal >= 1) : ?>
									<li date="<?= $unavailable ?>" data-total="<?= $unavailableTotal ?>" class="date_cell">
									<?php elseif ($holidayTotal >= 1) : ?>
									<li date="<?= $unavailable ?>" data-total="<?= $unavailableTotal ?>" class="bg-dark text-white date_cell">
									<?php else : ?>
									<li date="<?= $currentDate ?>" data-total="<?= $eventNum ?>" class="date_cell">
									<?php endif; ?>
									<div class="h-100">
										<?php if ($unavailableTotal > 0) : ?>
											<!-- Fill by time duration -->
											<div class="bg-dark" style="position: absolute; height: 5px; right: 0px; padding: 10px;"></div>
										<?php endif; ?>
										<div class="date_cell_info_hover d-flex flex-column position-absolute">
											<div class="date_cell_info px-2 pt-1">
												<!-- Date cell -->
												<b> <?= $dayCount; ?> </b>
											</div>
											<!-- Hover event -->
											<div id="date_popup_<?= $currentDate ?>" class="mt-auto p-1 none">
												<?php if ($eventNum > 0) : ?>
													<button type="button" data-date="<?= $eventNum ?>" style="color: #1A547E;" class="btn text-decoration-none btn-get-events" onclick="getEvents('<?= $currentDate ?>')">
														View Scheduled
													</button>
													test
												<?php elseif ($unavailableTotal > 0) : ?>
													<button type="button" data-date="<?= $unavailableTotal ?>" style="color: #1A547E;" class="off btn text-decoration-none btn-get-events" onclick="getEvents('<?= $currentDate ?>')">
														View Scheduled
													</button>
												<?php endif; ?>
											</div>
										</div>
									</div>
									</li>
									<?php $dayCount++; ?>
								<?php else : ?>
									<li><span></span></li>
								<?php endif; ?>

							<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div>
		<div id="event_list" class="my-3 none"></div>
	</div>
	<script type="text/javascript">
		function getCalendarDetails(target_div, year, month) {
			$.ajax({
				type: 'POST',
				url: _base_url_ + 'calendar.php',
				data: 'func=getCalender&year=' + year + '&month=' + month,
				success: function(html) {
					$('#' + target_div).html(html);
				}
			});
		}

		function getEvents(date) {
			$.ajax({
				type: 'POST',
				url: _base_url_ + 'calendar.php',
				data: 'func=getEvents&date=' + date,
				success: function(html) {
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}

		function addEvent(date) {
			$.ajax({
				type: 'POST',
				url: _base_url_ + 'calendar.php',
				data: 'func=addEvent&date=' + date,
				success: function(html) {
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}

		$(document).ready(function() {
			$('.date_cell').mouseenter(function(e) {
				date = $(this).attr('date');
				totalEvent = parseInt($(this).attr('data-total'));
				if (totalEvent) {
					$("#date_popup_" + date).fadeIn();
				}
			});
			$('.date_cell').mouseleave(function() {
				date = $(this).attr('date');
				totalEvent = parseInt($(this).attr('data-total'));
				if (totalEvent) {
					$("#date_popup_" + date).fadeOut();
				}
			});
			$('.month_dropdown').on('change', function() {
				getCalendarDetails('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
			});
			$('.year_dropdown').on('change', function() {
				getCalendarDetails('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = '')
{
	$options = '';
	for ($i = 1; $i <= 12; $i++) {
		$value = ($i < 10) ? '0' . $i : $i;
		$selectedOpt = ($value == $selected) ? 'selected' : '';
		$options .= '<option value="' . $value . '" ' . $selectedOpt . ' >' . date("F", mktime(0, 0, 0, $i + 1, 0, 0)) . '</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = '')
{
	$options = '';
	for ($i = 2022; $i <= 2030; $i++) {
		$selectedOpt = ($i == $selected) ? 'selected' : '';
		$options .= '<option value="' . $i . '" ' . $selectedOpt . ' >' . $i . '</option>';
	}
	return $options;
}

/*
 * Get events by date
 */
function getEvents($date = '')
{
	//Include db configuration file
	global $conn;
	$eventListHTML = '';
	$eventListHTML = '<h2 class="text-center">Scheduled on ' . date("l, d M Y", strtotime($date)) . '</h2>';
	$date = $date ? $date : date("Y-m-d");
	//Get events based on the current date
	$result = $conn->query("SELECT hours FROM appointment WHERE dates = '" . $date . "' AND status = 1 GROUP BY hours");
	$resultUnavailable = $conn->query("SELECT * FROM unavailable_dates WHERE schedule = '" . $date . "'");
	if ($result->num_rows > 0) {
		$eventListHTML .= '<ul>';
		while ($row = $result->fetch_assoc()) {
			$eventListHTML .= '<li>' . $row['hours'] . '</li>';
		}
		$eventListHTML .= '</ul>';
	}
	if ($resultUnavailable->num_rows > 0) {
		$eventListHTML .= '<ul>';
		while ($unRow = $resultUnavailable->fetch_assoc()) {
			$eventListHTML .= '<li>' . $unRow['schedule'] . ' ' . $unRow['from_hours'] . ' - ' . $unRow['to_hours'] . ' - <b>' . $unRow['comments'] . '</b></li>';
		}
		$eventListHTML .= '</ul>';
	}
	echo $eventListHTML;
}
?>