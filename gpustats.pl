#!/usr/bin/perl

$util="-"; $power="-";

print "<table cellpadding='10' cellspacing='10'><tr><td>Card</td><td>&nbsp;Utilisation</td><td>&nbsp;Power<td>&nbsp;Fan</td><td>&nbsp;Temperature</td><td>Memory Used</td></tr>\n";

while ($line=<STDIN>) {

    chomp($line);

    if ($line=~m!<gpu_temp>(\d*) C</gpu_temp>!) {
	$temp=$1;
    }

    if ($line=~m!<fan_speed>(\d*) %</fan_speed>!) {
        $fan=$1;
    }

    if ($line=~m!<product_name>(.+)</product_name>!) {
	$prod=$1;
    }
    
    if ($line=~m!<used>(.+) MiB</used>!) {
        $memused=$1;
    }

    if ($line=~m!<power_draw>(.+) W</power_draw>!) {
        $power=$1;
    }

    if ($line=~m!<gpu_util>(.+) %</gpu_util>!) {
        $util=$1;
    }


    if ($line=~m!</gpu>!) {

	if ($util eq "-") {
	    $util=`cat /tmp/gpu-util`;
	    chomp($util);
	}	   

	print '<tr><td>'.$prod.'</td><td align="right">&nbsp;'.$util.' %</td><td  align="right">&nbsp;'.$power.' W</td><td align="right">&nbsp;'.$fan.'%</td><td align="right">'.$temp.' C</td><td align="right">'.$memused.' MiB</td></tr>'."\n";

	$util="-"; $power="-";
    }
}

print "</table>\n";
