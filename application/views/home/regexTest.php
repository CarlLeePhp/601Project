<?php

$randomArray = array('123 Main st.','84 Lithgow st.','ori 9886 ave','bob st 303');
//allowed char for password a-z  A-Z 0-9 !@#$%^&*()-+_?.
//allowed char for name a-z A-Z 0-9 . ' - : , \s
//allowed char for DOB 2digits for dd separator -\s/ 2digits for mm separator -\s/ 4digits for yyyy
$matchName = preg_grep('%^$%',$randomArray);

foreach($matchName as $res){
    echo $res . '<br />' . '<br />';
}

echo '<br />';
?>