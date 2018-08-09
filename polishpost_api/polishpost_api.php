<?php
/**
 *
 * @package Polish Post API
 * @subpackage Main Class
 * @author RapidDev | Polish technology company
 * @copyright Copyright (c) 2018, RapidDev
 *
 * @link https://github.com/rapiddev/polishpost-php
 * @license https://github.com/rapiddev/polishpost-php/blob/master/LICENSE
 *
 * This file is part of the Polish Post tracking API.
 *
 * (c) RapidDev Leszek Pomianowski <https://rapiddev.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * More info about API and documentation can be found on:
 * http://www.poczta-polska.pl/webservices/
 *
 */
	if (!class_exists('PolishPostAPI')) {
		class PolishPostAPI
		{
			private $username, $password, $request_url, $request_body, $request_urn, $curl;

			public function __construct($username = 'sledzeniepp', $password = 'PPSA')
			{
				$this->username = $username;
				$this->password = $password;
			}

			public function get_package($package = 'testp0')
			{
				$this->request_url = 'http://tt.poczta-polska.pl/Sledzenie/services/Sledzenie.SledzenieHttpSoap11Endpoint/';
				$this->request_urn = 'sprawdzPrzesylkePl';
				$this->request_body = '<ns1:numer>'.$package.'</ns1:numer>';

				return $this->parse_xml($this->curl());
			}

			private function parse_xml($xml_data)
			{
				if (strpos($xml_data, 'soapenv:') !== false && function_exists('simplexml_load_string'))
				{
					return json_decode(json_encode(simplexml_load_string(str_ireplace(['soapenv:', 'ax21:', 'ns:', ':soapenv', 'xsi:'], '', $xml_data))),1);
				}
				else
				{
					return NULL;
				}
				
			}

			private function curl()
			{
				$XML_REQUEST = '<?xml version="1.0" encoding="UTF-8"?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://sledzenie.pocztapolska.pl" xmlns:ns2="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><SOAP-ENV:Header><ns2:Security SOAP-ENV:mustUnderstand="1"><ns2:UsernameToken><ns2:Username>'.$this->username.'</ns2:Username><ns2:Password>'.$this->password.'</ns2:Password></ns2:UsernameToken></ns2:Security></SOAP-ENV:Header><SOAP-ENV:Body><ns1:'.$this->request_urn.'>'.$this->request_body.'</ns1:'.$this->request_urn.'></SOAP-ENV:Body></SOAP-ENV:Envelope>';
				$this->curl = curl_init();
				curl_setopt($this->curl, CURLOPT_URL, $this->request_url);
				curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($this->curl, CURLOPT_POST, true);
				curl_setopt($this->curl, CURLOPT_POSTFIELDS, $XML_REQUEST);
				curl_setopt($this->curl, CURLOPT_HTTPHEADER,array('Connection: Keep-Alive','User-Agent: PHP-SOAP/7.1.1','Content-Type: text/xml; charset=utf-8','SOAPAction: "urn:'.$this->request_urn.'"','Content-length: '.strlen($XML_REQUEST)));
				$result = curl_exec($this->curl);
				if (curl_error($this->curl))
				{
					$error_msg = curl_error($this->curl);
				}
				curl_close($this->curl);
				if (isset($error_msg))
				{
					return $error_msg;
				}
				else
				{
					return $result;
				}
			}
		}
	}
?>