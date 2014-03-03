<?php


$options = array(
        'hoursMonday' => '8 to 8'
);

if (isset($options['hoursMonday'])) {
    
    $current_time = current_time( 'mysql' );
    //print_r($current_time[hours]);
    //print_r($options['hoursMonday']);
    //$now = time();
    //$current_timez = date("g", $now);
    //print_r($current_timez);
    
    $explode_hours = explode(" ", $options['hoursMonday']);
    
    $total_keys = count($explode_hours) - 1;
    
    if ($current_time[hours] > $explode_hours[0]  && $current_time[hours] < $explode_hours[$total_keys]) {
    	echo 'open';
    }
    else {
        echo 'closed';
    }

}

?>