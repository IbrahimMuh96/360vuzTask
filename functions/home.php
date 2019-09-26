<?php

use Antoineaugusti\EasyPHPCharts\Chart;
require 'vendor/autoload.php';

$query = "SELECT count(id) as count FROM 360vuz.users WHERE active = 0";
$statement = $db->prepare($query);
$statement->execute();
$inactive_users = $statement->fetch();


$query = "SELECT count(id) as count FROM 360vuz.users";
$statement = $db->prepare($query);
$statement->execute();
$all_usera = $statement->fetch();


$query = "SELECT * FROM 360vuz.users ORDER BY join_date DESC LIMIT 1";
$statement = $db->prepare($query);
$statement->execute();
$latest_user = $statement->fetch();

$query = "SELECT sum(login_times) as total FROM 360vuz.users";
$statement = $db->prepare($query);
$statement->execute();
$total_logins = $statement->fetch();

$query = "SELECT count(id) as count, login_date FROM 360vuz.login_history GROUP BY YEAR(login_date), MONTH(login_date)";
$statement = $db->prepare($query);
$statement->execute();
$monthly_login = $statement->fetchAll();

$months_count = array_column($monthly_login, 'count');
$months = array_column($monthly_login, 'login_date');
$format_month = array();

foreach ($months as $month) {
    array_push($format_month ,date("m-Y",strtotime($month)));
}

$pieChartMonth = new Chart('bar', 'examplePie1');
$pieChartMonth->set('data', $months_count);
$pieChartMonth->set('legend', $format_month);
$pieChartMonth->set('displayLegend', true);


$query = "SELECT count(id) as count, login_date FROM 360vuz.login_history GROUP BY YEAR(login_date), MONTH(login_date), WEEK(login_date)";
$statement = $db->prepare($query);
$statement->execute();
$weekly_login = $statement->fetchAll();


$weeks_count = array_column($weekly_login, 'count');
$weeks = array_column($weekly_login, 'login_date');
$format_week = array();

foreach ($weeks as $week) {
    array_push($format_week ,date("Y-m-d",strtotime($week)));
}

$pieChartWeek = new Chart('bar', 'examplePie2');
$pieChartWeek->set('data', $weeks_count);
$pieChartWeek->set('legend', $format_week);
$pieChartWeek->set('displayLegend', true);


$query = "SELECT count(id) as count, login_date FROM 360vuz.login_history GROUP BY YEAR(login_date), MONTH(login_date), WEEK(login_date), DAY(login_date)";
$statement = $db->prepare($query);
$statement->execute();
$daily_login = $statement->fetchAll();

$days_count = array_column($daily_login, 'count');
$days = array_column($daily_login, 'login_date');
$format_day = array();

foreach ($days as $day) {
    array_push($format_day ,date("Y-m-d",strtotime($day)));
}

$pieChartDay = new Chart('bar', 'examplePie3');
$pieChartDay->set('data', $days_count);
$pieChartDay->set('legend', $format_day);
$pieChartDay->set('displayLegend', true);

