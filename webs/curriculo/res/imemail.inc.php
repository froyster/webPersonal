<<<<<<< HEAD
<?php
  	//Incomedia WebSite X5 EMail Class. All rights reserved.
  
	class imEMail {
		var $from;
		var $to;
		var $subject;
		var $charset;
		var $text;
		var $html;
		
		var $attachments;
		
		function imEMail($from,$to,$subject,$charset) {
			$this->from = $from;
			$this->to = $to;
			$this->charset = $charset;
			$this->subject = "=?" . strtoupper($this->charset) . "?B?". base64_encode($subject) . "?=";			
		}
		
		function setFrom($from) {
			$this->from = $from;
		}
		
		function setTo($to) {
			$this->to = $to;
		}
		
		function setSubject($subject) {
			$this->subject = "=?" . strtoupper($this->charset) . "?B?". base64_encode($subject) . "?=";
		}
		
		function setCharset($charset) {
			$this->charset = $charset;
		}
		
		function setText($text) {
			$this->text = $text;
		}
		
		function setHTML($html) {
			$this->html = $html;
		}
		
		function attachFile($name,$content,$mime_type) {
			$attachment['name'] = "=?" . strtoupper($this->charset) . "?B?". base64_encode($name) . "?=";
			$attachment['content'] = base64_encode($content);
			$attachment['mime_type'] = $mime_type;
			$this->attachments[] = $attachment;
		}
		
		function send() {
			$headers = "";
			$msg = "";

			if($this->from == "" || $this->to == "" || ($this->text == "" && $this->html == ""))
				return false;
			
			$boundary_file = md5(time() . "_attachment");
			$boundary_alt = md5(time() . "_alternative");			

			$headers .= "From: " . $this->from . "\r\n";
			$headers .= "Message-ID: <" . time() . rand(0,9) . rand(0,9) . "@websitex5.users>\r\n";
			$headers .= "X-Mailer: WebSiteX5 Mailer\r\n";
			$headers .= "MIME-Version: 1.0\r\n";

			if(is_array($this->attachments)) {
				$headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary_file . "\"\r\n\r\n";
				$headers .= "--" . $boundary_file . "\r\n";
			}
			
			if($this->html == "") {
				$headers .= "Content-Type: text/plain; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
					$headers .= "Content-Transfer-Encoding: 7bit\r\n";
				else
				  	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= $this->text . "\r\n\r\n";
			}
			else if($this->text == "") {
				$headers .= "Content-Type: text/html; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
					$headers .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
				  	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= $this->html . "\r\n\r\n";
			}
			else {
				$headers .= "Content-Type: multipart/alternative; boundary=\"" . $boundary_alt . "\"\r\n";
				
				$msg .= "--" .$boundary_alt . "\r\n";
				$msg .= "Content-Type: text/plain; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
    				$msg .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
			  		$msg .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= "\r\n";
				$msg .= $this->text . "\r\n\r\n";
				
				$msg .= "--" . $boundary_alt . "\r\n";
			  	$msg .= "Content-Type: text/html; charset=" . strtoupper($this->charset) . "\r\n";
			  	if (strtolower($this->charset) != "utf-8")
					$msg .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
			  		$msg .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= "\r\n";
				$msg .= $this->html . "\r\n\r\n";
				
				$msg .= "--" . $boundary_alt . "--\r\n\r\n";
			}
			
			if(is_array($this->attachments)) {
				foreach($this->attachments as $attachment) {
					$msg .= "--" . $boundary_file . "\r\n";
					$msg .= "Content-Type: " . $attachment["mime_type"] . "; name=\"" . $attachment["name"] . "\"\r\n";
					$msg .= "Content-Transfer-Encoding: base64\r\n";
					$msg .= "Content-Disposition: attachment; filename=\"" . $attachment["name"] . "\"\r\n\r\n";
					$msg .= chunk_split($attachment["content"]) . "\r\n\r\n";
				}
			
				$msg .= "--" . $boundary_file . "--\r\n\r\n";
			}
			
			if (function_exists('ini_set'))
				@ini_set("sendmail_from", $this->from);
			
			$r = @mail($this->to, $this->subject, $msg, $headers, "-f" . $this->from);
			if(!$r) {
				$headers = "To: " . $this->to . "\r\n" . $headers;
				$r = @mail($this->to, $this->subject, $msg, $headers);
			}
			return $r;		
		}
	}

=======
<?php
  	//Incomedia WebSite X5 EMail Class. All rights reserved.
  
	class imEMail {
		var $from;
		var $to;
		var $subject;
		var $charset;
		var $text;
		var $html;
		
		var $attachments;
		
		function imEMail($from,$to,$subject,$charset) {
			$this->from = $from;
			$this->to = $to;
			$this->charset = $charset;
			$this->subject = "=?" . strtoupper($this->charset) . "?B?". base64_encode($subject) . "?=";			
		}
		
		function setFrom($from) {
			$this->from = $from;
		}
		
		function setTo($to) {
			$this->to = $to;
		}
		
		function setSubject($subject) {
			$this->subject = "=?" . strtoupper($this->charset) . "?B?". base64_encode($subject) . "?=";
		}
		
		function setCharset($charset) {
			$this->charset = $charset;
		}
		
		function setText($text) {
			$this->text = $text;
		}
		
		function setHTML($html) {
			$this->html = $html;
		}
		
		function attachFile($name,$content,$mime_type) {
			$attachment['name'] = "=?" . strtoupper($this->charset) . "?B?". base64_encode($name) . "?=";
			$attachment['content'] = base64_encode($content);
			$attachment['mime_type'] = $mime_type;
			$this->attachments[] = $attachment;
		}
		
		function send() {
			$headers = "";
			$msg = "";

			if($this->from == "" || $this->to == "" || ($this->text == "" && $this->html == ""))
				return false;
			
			$boundary_file = md5(time() . "_attachment");
			$boundary_alt = md5(time() . "_alternative");			

			$headers .= "From: " . $this->from . "\r\n";
			$headers .= "Message-ID: <" . time() . rand(0,9) . rand(0,9) . "@websitex5.users>\r\n";
			$headers .= "X-Mailer: WebSiteX5 Mailer\r\n";
			$headers .= "MIME-Version: 1.0\r\n";

			if(is_array($this->attachments)) {
				$headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary_file . "\"\r\n\r\n";
				$headers .= "--" . $boundary_file . "\r\n";
			}
			
			if($this->html == "") {
				$headers .= "Content-Type: text/plain; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
					$headers .= "Content-Transfer-Encoding: 7bit\r\n";
				else
				  	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= $this->text . "\r\n\r\n";
			}
			else if($this->text == "") {
				$headers .= "Content-Type: text/html; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
					$headers .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
				  	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= $this->html . "\r\n\r\n";
			}
			else {
				$headers .= "Content-Type: multipart/alternative; boundary=\"" . $boundary_alt . "\"\r\n";
				
				$msg .= "--" .$boundary_alt . "\r\n";
				$msg .= "Content-Type: text/plain; charset=" . strtoupper($this->charset) . "\r\n";
				if (strtolower($this->charset) != "utf-8")
    				$msg .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
			  		$msg .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= "\r\n";
				$msg .= $this->text . "\r\n\r\n";
				
				$msg .= "--" . $boundary_alt . "\r\n";
			  	$msg .= "Content-Type: text/html; charset=" . strtoupper($this->charset) . "\r\n";
			  	if (strtolower($this->charset) != "utf-8")
					$msg .= "Content-Transfer-Encoding: 7bit\r\n";
        		else
			  		$msg .= "Content-Transfer-Encoding: 8bit\r\n";
				$msg .= "\r\n";
				$msg .= $this->html . "\r\n\r\n";
				
				$msg .= "--" . $boundary_alt . "--\r\n\r\n";
			}
			
			if(is_array($this->attachments)) {
				foreach($this->attachments as $attachment) {
					$msg .= "--" . $boundary_file . "\r\n";
					$msg .= "Content-Type: " . $attachment["mime_type"] . "; name=\"" . $attachment["name"] . "\"\r\n";
					$msg .= "Content-Transfer-Encoding: base64\r\n";
					$msg .= "Content-Disposition: attachment; filename=\"" . $attachment["name"] . "\"\r\n\r\n";
					$msg .= chunk_split($attachment["content"]) . "\r\n\r\n";
				}
			
				$msg .= "--" . $boundary_file . "--\r\n\r\n";
			}
			
			if (function_exists('ini_set'))
				@ini_set("sendmail_from", $this->from);
			
			$r = @mail($this->to, $this->subject, $msg, $headers, "-f" . $this->from);
			if(!$r) {
				$headers = "To: " . $this->to . "\r\n" . $headers;
				$r = @mail($this->to, $this->subject, $msg, $headers);
			}
			return $r;		
		}
	}

>>>>>>> 20f28141af7ed81ccc0b9dbc430733cdc5f8e5d3
// End of file imemail.inc.php