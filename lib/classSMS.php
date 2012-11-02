<?php
/*
http://api.clickatell.com/http/sendotp?api_id=xxxx&user=xxxx&password=xxxx&to=xxxx&text=Bitte+verifiziere+dich+mit+dem+Passwort+beim+SMS-Dienst+%23OTP%23&lifetime=xxxx
lifetime - default:900 seconds
Response:
ID: apimsgid
or
ERR: Error number

http://api.clickatell.com/http/verifyotp.php?user=xxxx&password=xxxx&api_id=xxxx&to=xxxx&otp=xxxx&apiMsgId=xxxx&sender_id=1
Response:
OK: 279990002 (the number)
or
ERR: number, description

NB: Sending a second one-time password to the same handset from the same account will immediately expire any previous OTP sent to that handset.

2.3 Errors
124 "Missing OTP tag"
125 "apiMsgId (API Message ID) does not match api_id or dest_addr"
126 "OTP password does not match"
127 "OTP expired"

 */

	
class SMS extends Config{

	static function msgencode($t){
		$t = urlencode($t); 
			/*strtr($t, array(
				"@" => "%00",
				"£" => "%01",
				"$" => "%02",
				"¥" => "%03",
				"è" => "%04",
				"é" => "%05",
				"ù" => "%06",
				"ì" => "%07",
				"ò" => "%08",
				"Ç" => "%09",
					"\r\n" => "%0A",
					"\n" => "%0A",
					"\r" => "%0A",
				"Ø" => "%0B",
				"ø" => "%0C",
				//		"\n" => "%0D",
				"Å" => "%0E",
				"å" => "%0F",
				"Δ" => "%10",
				"_" => "%11",
				"Φ" => "%12",
				"Γ" => "%13",
				"Λ" => "%14",
				"Ω" => "%15",
				"Π" => "%16",
				"Ψ" => "%17",
				"Σ" => "%18",
				"Θ" => "%19",
				"Ξ" => "%1A",
				//	"escape" => "%1B",
				//	"form feed" => "%1B%0A"
				"^" => "%1B%14",
				"{" => "%1B%28",
				"}" => "%1B%29",
				"\\" => "%1B%2F",
				"[" => "%1B%3C",
				"~" => "%1B%3D",
				"]" => "%1B%3E",
				"|" => "%1B%40",
				"€" => "%1B%65",
				"Æ" => "%1C",
				"æ" => "%1D",
				"ß" => "%1E",
				"É" => "%1F",
				" " => "%20",
				"!" => "%21",
				"\"" => "%22",
				"#" => "%23",
				"¤" => "%24",
				"%" => "%25",
				"&" => "%26",
				"\'" => "%27",
				"(" => "%28",
				")" => "%29",
				"*" => "%2A",
				"+" => "%2B",
				"," => "%2C",
				"-" => "%2D",
				"." => "%2E",
				"/" => "%2F",
				//digits %30-%39
				":" => "%3A",
				";" => "%3B",
				"<" => "%3C",
				"=" => "%3D",
				">" => "%3E",
				"?" => "%3F",
				"¡" => "%40",
				//upper chars %41-%5A
				"Ä" => "%5B",
				"Ö" => "%5C",
				"Ñ" => "%5D",
				"Ü" => "%5E",
				"§" => "%5F",
				"¿" => "%60",
				//lower chars %61-%7A
				"ä" => "%7B",
				"ö" => "%7C",
				"ñ" => "%7D",
				"ü" => "%7E",
				"à" => "%7F"
			));*/
			
		return $t;
	}

	private static function call($name){
		return file2(self::$baseurl."/http/$name?api_id=".self::$apiid."&user=".self::$user."&password=".self::$pw);
	}
	
	private static function mcall($sess_id,$to,$msg,$flash=""){	
		if ($flash!=="") {
			$flash ="&msg_type=SMS_FLASH";
		}
		return file2(self::$baseurl."/http/sendmsg?session_id=$sess_id&to=$to&text=$msg&from=Pirate-SMS".$flash);
	}


	static function credits(){
		$n = getpart(self::call("getbalance"));
		return adef($n,1,"N/A");
	}
	
	static function send($tos,$msg){
		echo "<div style='background-color:#F00'>";
		foreach ($tos as $tox) {
			$to=$tox->mobile;
			$text = self::msgencode($msg);
			$sess = getpart(self::call("auth"));
			
			if ($sess[0] == "OK") {
				$sess_id = trim($sess[1]); // remove any whitespace
				$ret=self::mcall($sess_id,$to,$text);
				//echo "$sess_id - $to - $text";
				//$send = split(":",$ret[0]);
		$send = getpart($ret);
				if ($send[0] == "ID")
					echo "";//echo "<br />success! message ID: ". $send[1];
				else
					echo "send message failed for ".$tox->caption();
			} else {
				echo "Authentication failure: ". $ret[0];
				exit();
			}
		}
		echo "</div><br>";
	}
}


?>
