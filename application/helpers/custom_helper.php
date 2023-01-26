<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function create_fullname($fname='',$lname='',$mname='',$xname=''){

$name = $fname. ' ' .$mname. ' ' . $lname;

if(!empty($name) && !empty($xname)){
    $name .= ' , ' .$xname;
}

return $name;
}

?>