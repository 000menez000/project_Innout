<?php
// Controller Temporário

loadModel('WorkingHours');

$wh = WorkingHours::loadFromUserAndDate(1, date('Y-m-d'));
$wh->getTimes();