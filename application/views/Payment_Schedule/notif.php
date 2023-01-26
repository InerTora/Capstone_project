<h1>Notification Message</h1>

<?php
 $exp_date = date('2022-11-21');
 $today_date = date('Y-m-d');

 $exp = strtotime($exp_date);
 $td = strtotime($today_date);

     $diff = $td-$exp;
     $days = abs(floor($diff / (60*60*24)));
echo  $days;

if ($days == 3) {
   echo "Bank loan will due in 3 days";
}

    


?>