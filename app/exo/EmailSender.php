<?php

namespace Exo;

class EmailSender
{

	function __construct()
	{
		//
	}

	public function sendEmail($emailReceiver, $messageContent, $age)
	{
	    if($age < 18)
		    return true;

	    return false;
	}

}

?>