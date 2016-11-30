<?php

	$human = $_POST['human'];		
	
	$errors = array();
	$data = array();		
	if(empty($_POST['name'])){
		 $errors['name']= "A name is required.";
	}

	if(empty($_POST['email'])){
		 $errors['email']= "A return email address is required.";
	}
	if(empty($_POST['message'])){
		 $errors['message']= "A message is required.";
	}
	if(empty($_POST['human']) || $human != '4'){
		 $errors['human']= "Human validation question omitted or incorrect.";
	}

	if(empty($errors)){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$from = 'From: ' + $name; 
		$to = 'andrew@oneoverx.co'; 
		$subject = 'Contact Form Filled Out';
		$body = "From: $name\n E-Mail: $email\n Message:\n $message";
		mail ($to, $subject, $body, $from);
		$data['success'] = true;
		$data['message'] = '<div class="alert alert-success email-alert" role="alert" id="email-success"><p><b>Message sent successfully.</b> I\'ll get back to you as soon as possible! If you need to send another message, please refresh the page.</p>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
	} else {
		$data['success'] = false;
		$failure = "<div class=\"alert alert-danger email-alert\" role=\"alert\" id=\"email-failure\">\n \t <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n<span aria-hidden=\"true\">&times;</span></button> \n<p><b>Message not delivered!</b> Please fix the following errors and try again:</p>\n \t 
		\t <ul>\n";

		foreach ($errors as $error){
			$failure = $failure . " \t \t <li>". $error ."</li>\n";
		}
		$failure = $failure . "</ul>\n</div>";
		$data['errors'] = $failure;
	}
	
	echo json_encode($data);

?>