<?php

function formatNumber($num) 
{
    if ($num > 9999 && $num <= 999999) {
        // $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 10000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . 'K';
    } else if ($num > 999999) {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000000; $i++) {
            $num /= 1000000;
        }
        return round($num, 1) . 'M';
    } else {
        return number_format($num, 2);
    }
}


function formatDate($date){
    return \Carbon\Carbon::create($date)->format('F jS, Y');
}

function formatChatDate($date){
    return \Carbon\Carbon::create($date)->format('D, M d Y, h:m a');
}

function formatTime($date){
    return \Carbon\Carbon::create($date)->format('h:m a');
}


function humanTime($date){
    return \Carbon\Carbon::create($date)->diffForHumans();
}
