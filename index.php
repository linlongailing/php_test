<?php
// include "./helper.php";

// $a=helper(array('charset','utf'));
// var_dump($a);
// echo "<br>";
// charset();


// $b=helper(array('charset','utf'));
// var_dump($b);


function SpUpdateStat()
{
    global $cfg_version;
    if(empty($cfg_version))
    {
        $cfg_version = 'notknow';
    }
    $statport = array(0x68,0x74,0x74,0x70,0x3a,0x2f,0x2f,0x77,0x77,0x77,0x2e,0x64,0x65,0x64,0x65,
    0x63,0x6d,0x73,0x2e,0x63,0x6f,0x6d,0x2f,0x73,0x74,0x61,0x74,0x2e,0x70,0x68,0x70,
    0x3f,0x72,0x66,0x68,0x6f,0x73,0x74,0x3d);
    $staturl = '';
    foreach($statport as $c)
    {
        $staturl .= chr($c);
    }
    $staturl = $staturl.urlencode($_SERVER['HTTP_HOST']).'&ver='.urlencode($cfg_version);
    echo $staturl;
    $stat = @file_get_contents($staturl);
    return $stat;
}

echo SpUpdateStat();