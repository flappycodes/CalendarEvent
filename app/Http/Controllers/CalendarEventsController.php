<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CalendarEvents;

use DateInterval;
use DateTime;
use DatePeriod;

class CalendarEventsController extends Controller
{
    public function index(Request $req){
    	$dates = [];
    	$header = '';

    	$events = CalendarEvents::orderBy('id', 'desc')->first();
    	$days = json_decode($events->days, 1);
    	$monday = $days['monday'] ? 'Monday' : '';
		$tuesday = $days['tuesday'] ? 'Tuesday' : '';
		$wednesday = $days['wednesday'] ? 'Wednesday' : '';
		$thursday = $days['thursday'] ? 'Thursday' : '';
		$friday = $days['friday'] ? 'Friday' : '';
		$saturday = $days['saturday'] ? 'Saturday' : '';
		$sunday = $days['sunday'] ? 'Sunday' : '';

		$begin = new DateTime($events->from);
		$end = new DateTime($events->to);

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		foreach ($period as $dt) {
			if ($monday == $dt->format("l")
			|| $tuesday == $dt->format("l")
			|| $wednesday == $dt->format("l")
		 	|| $thursday == $dt->format("l")
		 	|| $friday == $dt->format("l")
		 	|| $friday == $dt->format("l")
		 	|| $saturday == $dt->format("l")
		 	|| $sunday == $dt->format("l")) {
				$type = 'success';
			}else{
				$type = '';
			}

			$header = $dt->format("M").' '.$dt->format("Y");

			$dates[] = array(
				'event' => $events->event_name,
				'day' => $dt->format("d").' '.$dt->format("l"),
				'type' => $type
			);
		}

		return compact('dates', 'header');
    }

    public function create(Request $req){
    	$success = false;
    	$dates = [];
    	$header = '';

    	$monday = $req->monday ? 'Monday' : '';
		$tuesday = $req->tuesday ? 'Tuesday' : '';
		$wednesday = $req->wednesday ? 'Wednesday' : '';
		$thursday = $req->thursday ? 'Thursday' : '';
		$friday = $req->friday ? 'Friday' : '';
		$saturday = $req->saturday ? 'Saturday' : '';
		$sunday = $req->sunday ? 'Sunday' : '';

    	$days = array(
			'monday' => $req->monday,
			'tuesday' => $req->tuesday,
			'wednesday' => $req->wednesday,
			'thursday' => $req->thursday,
			'friday' => $req->friday,
			'saturday' => $req->saturday,
			'sunday' => $req->sunday
		);

		$data = array(
			'event_name' => $req->event_title,
			'from' => $req->event_from,
			'to' => $req->event_to,
			'days' => json_encode($days, 1)
		);

		$begin = new DateTime($req->event_from);
		$end = new DateTime($req->event_to);

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		foreach ($period as $dt) {
			if ($monday == $dt->format("l")
			|| $tuesday == $dt->format("l")
			|| $wednesday == $dt->format("l")
		 	|| $thursday == $dt->format("l")
		 	|| $friday == $dt->format("l")
		 	|| $friday == $dt->format("l")
		 	|| $saturday == $dt->format("l")
		 	|| $sunday == $dt->format("l")) {
				$type = 'success';
			}else{
				$type = '';
			}
			$header = $dt->format("M").' '.$dt->format("Y");
			$dates[] = array(
				'event' => $req->event_title,
				
				'day' => $dt->format("d").' '.$dt->format("l"),
				'type' => $type
			);
		}

		$create = CalendarEvents::updateOrCreate(['event_name' => $req->event_title], $data);
		if ($create) {
			$success = true;
		}
		return compact('success', 'dates', 'header');
    }
}