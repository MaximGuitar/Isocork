<?php
	require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

	require 'mail/Validator.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use Valitron\Validator as Valitron;

	Valitron::langDir(__DIR__.'/mail/lang');
	Valitron::lang('ru');

	function send_response($response_arr){
		$result = json_encode($response_arr);
		die($result);
	}
	function render_partial($template_path, $render_data) {
		extract(['args' => $render_data]);
		require $template_path;
	  }
	function send_mail($mail_content, $is_test = true){
		$result = ['status' => 'success'];
		$recipientsTo = COption::GetOptionString("main", "email_from", "");


		try{
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 4;                      //Enable verbose debug output
            //$mail->Debugoutput = 'echo';                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.system.place-start.ru';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'isocork-ru';                     //SMTP username
            $mail->Password   = 'WesternPersonAlaskaFortieth09';
            $mail->Port       = 250;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			$mail->setFrom('isocork@bitrix.ps', 'isocork.ru');

            //Recipients
            $mail->addAddress($recipientsTo);
			//$mail->addAddress($recipientsTo);
			// $mail->AddBCC("feadback@place-start.ru");


            //Content
			$link = isset($mail_content['sent_from_page_link']) ? $mail_content['sent_from_page_link'] : false;
			$footer = create_mail_tpl('mail-footer', [
				'ip' => $_SERVER['REMOTE_ADDR'],
				'info' => $_SERVER['HTTP_USER_AGENT'],
				'link' => $link,
				'date' => date('d.m.Y'),
				'time' => date('G:i')
			]);
			
            $mail->isHTML();                                //Set email format to HTML
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $mail_content['subject'];
            $mail->Body    = $mail_content['body'].$footer;

			if($_FILES['file']) {
				$uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
				$filename = $_FILES['file']['name'];
				if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
					$mail->addAttachment($uploadfile, $filename);
				}
			}

            $mail->send();
		}
		catch(Exception $e){
			$result['status'] = "mail-not-sent";
			$result['message'] = $mail->ErrorInfo;
		}

		return $result;
	}
	function create_mail_tpl($tpl_name, $params){
		ob_start();
		render_partial($_SERVER["DOCUMENT_ROOT"]."/local/templates/isocork/ajax/mail/tpls/$tpl_name.php", $params);
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
	function feedback(){
		$result = [
			'status' => 'success',
		];

		$title = 'Обратный звонок';

		if($_REQUEST['form-title']) {
			$title = $_REQUEST['form-title'];
		}

		$forms = [
			'form-callback' => $title,
			'form-callback-email' => $title,
			'form-dealer' => $title,
			'form-callback-dealer' => 'Связаться с нами',
			'form-calc' => $title,
		];
		if ( !isset($_REQUEST['form-id']) || !array_key_exists($_REQUEST['form-id'], $forms) ){
			$result['status'] = 'invalid-form-id';
			$result['message'] = 'Неправильный form-id';
			send_response($result);
		}

		$form_id = $_REQUEST['form-id'];

		$result['errors'] = [];
		$v = new Valitron($_REQUEST);
		switch ($form_id) {
			case 'form-callback':
			case 'form-callback-dealer':
				$v->rule('required','tel');
				$v->rule('regex', 'tel', '/(8|\+7)\ \(\d{3}\)\ \d{3}-\d{2}-\d{2}/i');
				break;
			case 'form-callback-email':
				$v->rule('required','email');
				$v->rule('email', 'email');
				$v->rule('required','tel');
				$v->rule('regex', 'tel', '/(8|\+7)\ \(\d{3}\)\ \d{3}-\d{2}-\d{2}/i');
				break;
			case 'form-dealer':
				$v->rule('required','email');
				$v->rule('email', 'email');
				$v->rule('required','tel');
				$v->rule('regex', 'tel', '/(8|\+7)\ \(\d{3}\)\ \d{3}-\d{2}-\d{2}/i');
				$v->rule('required','name');

				if($_FILES['file']['error'] != 4) {
					$result['errors']['file'] = file_validation('file', ['image/jpeg', 'image/png', 'application/pdf', 'application/docx'], 3072);
				}
				
				break;
			case 'form-calc':
				$v->rule('required','email');
				$v->rule('email', 'email');
				$v->rule('required','tel');
				$v->rule('regex', 'tel', '/(8|\+7)\ \(\d{3}\)\ \d{3}-\d{2}-\d{2}/i');
				$v->rule('required','name');
				break;
		}

		if(!$v->validate() || $_REQUEST['recaptcha-value'] == 'not-valid') {
		    $result['status'] = 'not-valid';
		    $result['errors'] = array_merge($result['errors'], $v->errors());
		}

		if ($result['status'] == 'success'){

			$title = $forms[$form_id];
			$body = create_mail_tpl("$form_id-mail-tpl", $_REQUEST);
			$mail_result = send_mail([
				'subject' => $title,
				'body' => $body,
				'sent_from_page_link' => $_REQUEST['href']
			]);

			$result['mail'] = $mail_result;
			$result['body'] = $body;
			$result['form_id'] = $form_id;

			if($mail_result['status'] == 'mail-not-sent'){
				$result['status'] = "mail-not-sent";
				$result['message'] = $mail_result['message'];
			}
		}

		send_response($result);
	}
	function file_validation($key, $allowed_types, $maxsize){
		$result = [];

		$mimes = [
			'image/png',
			'image/gif',
			'image/jpeg',
			'image/tiff',
			'text/plain',
			'text/richtext',
			'application/msword',
			'application/pdf',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/vnd.oasis.opendocument.text',
			'application/vnd.oasis.opendocument.spreadsheet',
			'application/vnd.ms-powerpoint',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'application/rtf',
			'application/vnd.ms-excel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'application/x-abiword'

		];

		if (!$allowed_types)
			$allowed_types = $mimes;

		$phpFileUploadErrors = array(
			0 => 'There is no error, the file uploaded with success',
			1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
			2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
			3 => 'The uploaded file was only partially uploaded',
			4 => 'No file was uploaded',
			6 => 'Missing a temporary folder',
			7 => 'Failed to write file to disk.',
			8 => 'A PHP extension stopped the file upload.',
		);

		$file_info = $_FILES[$key];


		if ( $file_info['error'] != 0 ){
			if ( $file_info['error'] == 4 ){
				$result['status'] = 'file-not-uploaded';	
			}
			else{
				$result['message'] = $phpFileUploadErrors[$file_info['error']];
			}
			return $result;
		}

		if ($file_info['size'] > $maxsize){
			array_push($result, 'Размер файла больше допустимого');
		}

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		if (false === $ext = array_search(
			$finfo->file($file_info['tmp_name']),
			$allowed_types,
			true
		)){
			array_push($result, 'Неверный формат');
		}

		// var_dump($result);
		return $result;
	}

	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    switch ($action) {
        case 'feedback':
            feedback();
            break;
        
        default:
            return;
    }
?>
