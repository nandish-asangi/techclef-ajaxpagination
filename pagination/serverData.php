<?php

include_once("connection.php");

$curr = $_GET["val"];

$count = mysql_query("select * from pagination") or die(mysql_error());
$count = mysql_num_rows($count);

$rs = mysql_query("select * from pagination limit $curr,7");

$out = "<table border=1 width='100%' height='50%' cellspacing=1px cellpadding=10px>";
$out = $out . "<tr height='25px'><th>Serial</th><th>Name</th><th>Contact</th><th>Email</th><th>State</th><th>Country</th><th>Postal/ZIP</th></tr>";

while($row = mysql_fetch_array($rs))
{
	$out = $out . "<tr align='left'>";
	$out = $out . "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td>";
	$out = $out . "</tr>";
}

$pg = "<div class='pagination'>";
$num = 7;
$nums = ceil($count/$num);
$i=0;

if($curr != 0)
	$pg = $pg . "<li class='button' onclick='getData(".($i)*$num.")'>First</li>";

if($curr != 0)
	$pg = $pg . "<li class='button' onclick='getData(".($curr-7).")'>Previous</li>";

while($i<$nums)
{
	if($curr==($i*7))
		$pg = $pg . "<li class='custom-button' onclick='getData(".($i)*$num.")'>".($i+1)."</li>";
	else
		$pg = $pg . "<li class='button' onclick='getData(".($i)*$num.")'>".($i+1)."</li>";	
	$i++;
}

if($curr == (($nums-1)*7))
{
	if(($nums*7)>$count)
	{
		$count = ($nums*7)-$count;

		while($count>0)
		{
			$out = $out . "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
			$count--;
		}
	}
}

$out = $out . "</table>";

if($curr != (($nums-1)*7))
	$pg = $pg ."<li class='button' onclick='getData(".($curr+7).")'>Next</li>";

if($curr != (($nums-1)*7))
	$pg = $pg ."<li class='button' onclick='getData(".(($nums-1)*7).")'>Last</li>";


$pg = $pg . "</div>";

$out = $out . $pg;
echo $out;	

?>