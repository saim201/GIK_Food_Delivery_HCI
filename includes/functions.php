<?php 



function isLoggedIn()
{
    if(isset($_SESSION['username']))
    {
        return true;
    }
    else
    {
    	return false;
    }
}





 ?>