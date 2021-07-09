#!/bin/perl

$mins=120;

open (FH,"/var/hashcrack/temps.txt");
$temps=<FH>;
chomp($temps);
@atemps=split(m/,/,$temps);
close FH;

open (FH,"/var/hashcrack/fan.txt");
$fan=<FH>;
chomp($fan);
@afan=split(m/,/,$fan);
close FH;

$temp=`nvidia-smi --query-gpu=temperature.gpu --format=csv,noheader,nounits | awk 'BEGIN {max = 0} {if (\$1>max) max=\$1} END {print max}'`;

$fan=`nvidia-smi --query-gpu=fan.speed --format=csv,noheader,nounits | awk 'BEGIN {max = 0} {if (\$1>max) max=\$1} END {print max}'`;

chomp($temp);
chomp($fan);

open(FH, '>', '/var/hashcrack/temps.txt');
$l=scalar @atemps;
$i=0; $acc="";
if ($l>$mins) { $i=$l-$mins; } 
while ( $i < $l ) {
    $acc .= $atemps[$i].",";
    $i++;   
}
$acc.=$temp;
print FH $acc;
close FH; 


open(FH, '>', '/var/hashcrack/fan.txt');
$l=scalar @afan;
$i=0; $acc2="";
if ($l>$mins) { $i=$l-$mins; }
while ( $i < $l ) {
    $acc2 .= $afan[$i].",";
    $i++;
}
$acc2.=$fan;
print FH $acc2;
close FH;

open(FH, '>', '/var/hashcrack/temps-py.txt');

print FH "dict(  fan_speed = [ ".$acc2." ], temperature = [ ".$acc." ] )\n";

close FH;

