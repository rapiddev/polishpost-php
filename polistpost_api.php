<?php

	function polish_post_packageinfo($packagenumber, $username = 'sledzeniepp', $password = 'PPSA'){
		$xml_request = '<?xml version="1.0" encoding="UTF-8"?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://sledzenie.pocztapolska.pl" xmlns:ns2="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><SOAP-ENV:Header><ns2:Security SOAP-ENV:mustUnderstand="1"><ns2:UsernameToken><ns2:Username>'.$username.'</ns2:Username><ns2:Password>'.$password.'</ns2:Password></ns2:UsernameToken></ns2:Security></SOAP-ENV:Header><SOAP-ENV:Body><ns1:sprawdzPrzesylkePl><ns1:numer>'.$packagenumber.'</ns1:numer></ns1:sprawdzPrzesylkePl></SOAP-ENV:Body></SOAP-ENV:Envelope>';
		$SOAP = curl_init();
		curl_setopt($SOAP, CURLOPT_URL,"http://tt.poczta-polska.pl/Sledzenie/services/Sledzenie.SledzenieHttpSoap11Endpoint/");
		curl_setopt($SOAP, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($SOAP, CURLOPT_POST, true);
		curl_setopt($SOAP, CURLOPT_POSTFIELDS, $xml_request);
		curl_setopt($SOAP, CURLOPT_HTTPHEADER,array('Connection: Keep-Alive','User-Agent: PHP-SOAP/7.1.1','Content-Type: text/xml; charset=utf-8','SOAPAction: "urn:sprawdzPrzesylkePl"','Content-length: '.strlen($xml_request),));
		$result = curl_exec($SOAP);
		if (curl_error($SOAP)) {
			$error_msg = curl_error($SOAP);
		}
		curl_close($SOAP);
		if (isset($error_msg)) {
			return $error_msg;
		}else{
			$result = str_ireplace(['soapenv:', 'ax21:', 'ns:', ':soapenv', 'xsi:'], '', $result);
			$result = simplexml_load_string($result);
			$result = json_decode(json_encode($result) , 1);
			if (isset($result['Body']['sprawdzPrzesylkePlResponse']['return']['status'])) {
				return $result['Body']['sprawdzPrzesylkePlResponse']['return']['danePrzesylki'];
			}else{
				return NULL;
			}
		}
	}

?>