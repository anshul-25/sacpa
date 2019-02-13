<?php

echo "Processed Data from the database - <br>";
require("student_atten_aca.php");
echo "<br><br>";

echo "Algorithm output based on dummy data - <br>";
$command = escapeshellcmd('regression.py');
$output = shell_exec($command);
echo $output;

?>