<?php
loadModel('WorkingHours');

Database::executeSQL('DELETE FROM working_hours');
Database::executeSQL('DELETE FROM users WHERE id > 5');

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate) {
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME,
    ];
    
    $extraHourDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME + 3600,
    ];
    
    $lazyDayTemplate = [
        'time1' => '08:30:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME - 1800,
    ];

    $value = rand(0, 100);
    if($value <= $regularRate) {
        return $regularDayTemplate;
    } elseif($value <= $regularRate + $extraRate) {
        return $extraHourDayTemplate;
    } else {
        return $lazyDayTemplate;
    }
}

function populateWorkingHours($userId, $initalDate, $regularRate, $extraRate, $lazyRate) {
    $currentDate = $initalDate;
    $today = new DateTime();
    $yesterday = $today->modify('-1 day');
    $columns = ['user_id' => $userId, 'work_date' => $currentDate];

    while(isBefore($currentDate, $yesterday)) {
        if(!isWeekend($currentDate)) {
            $template = getDayTemplateByOdds($regularRate, $extraRate, $lazyRate);
            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            $workingHours->insert();
        }

        $currentDate = getNextDay($currentDate)->format('Y-m-d');
        $columns['work_date'] = $currentDate;
    }
}

$lastMonth = strtotime('first day of last month');
populateWorkingHours(1, date('Y-m-1'), 70, 20, 10); // user 'Admin'
populateWorkingHours(3, date('Y-m-d', $lastMonth), 20, 75, 5); // user 'Seu Barriga' 
populateWorkingHours(4, date('Y-m-d', $lastMonth), 20, 10, 70); // user 'Seu Madruga'

echo 'tudo certo';

 