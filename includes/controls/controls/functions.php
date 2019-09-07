<?php
 //function.php

 //clean the function to prevent the injection

 /* Built in function used :
    trim()
    stripslashes()
    htmlspecialchars()
    strip_tags()
    str_replace()
 */
 function validateFormData($formData){
   $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array ( '(', ')'),'',$formData ) ),ENT_QUOTES ) ) );
   return $formData;
 }
?>