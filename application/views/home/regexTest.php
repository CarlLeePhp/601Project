<?php

$randomArray = array('-','mr.','mrs.','dr.','miss','ms.');
//allowed char for password a-z  A-Z 0-9 !@#$%^&*()-+_?.
//allowed char for name a-z A-Z 0-9 . ' - : , \s

/*allowed char for DOB first character can only be one or 2 followed by 
possibility 9 or 0 followed by 0-9 digits for tenth
year and year - sign separator 
followed by month first digit can only be 1 or 2 
if 0 is the first digit the second digit
would be 0-9 else if the first digit for month is 1 it could only be either 0 1 or 2
*/
//allowed char for address 
//allowed char for ZIP 4DIGITs
//allowed char for suburb a-z A-Z \s / . ' " : & , : 
$matchName = preg_grep('%^(m|d|-)[ris]{0,3}[\.]?$%',$randomArray);

foreach($matchName as $res){
    echo $res  . '<br />' . '<br />';
}
?>