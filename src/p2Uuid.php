<?php
namespace p2made\Uuid;

use p2made\Uuid\Uuid;

class P2UUID extends CApplicationComponent
{
	const REVERSE_DOMAIN = "";
	const HYPHEN_DEFAULT = true; // modify according to preference

	const SUBDOMAIN_UUID = 1;
	const SUBDOMAIN_RAND = 2;
	const SUBDOMAIN_TIME = 3;
	const SUBDOMAIN_NONE = 0;
	const SUBDOMAIN_DEFAULT = 1;



	public function p2v1uuid($dehyphenate = self::STRIP_DEFAULT)
	{
		require_once('class.uuid.php');
		$tmp = UUID::generate(UUID::UUID_TIME, UUID::FMT_STRING, self::p2random_hex());
		return self::p2uuid_output($tmp, $dehyphenate);
	}

	public function p2v3uuid($dehyphenate = self::STRIP_DEFAULT)
	{
		require_once('class.uuid.php');
		$tmp = UUID::generate(UUID::UUID_NAME_MD5, UUID::FMT_STRING, self::p2name(), UUID::NS_URL);
		return self::p2uuid_output($tmp, $dehyphenate);
	}

	public function p2v4uuid($dehyphenate = self::STRIP_DEFAULT)
	{
		require_once('class.uuid.php');
		$tmp = UUID::generate(UUID::UUID_RANDOM, UUID::FMT_STRING);
		return self::p2uuid_output($tmp, $dehyphenate);
	}

	public function p2v5uuid($dehyphenate = self::STRIP_DEFAULT)
	{
		require_once('class.uuid.php');
		$tmp = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, self::p2name(), UUID::NS_URL);
		return self::p2uuid_output($tmp, $dehyphenate);
	}



	protected function p2uuidOut($input, $hyphens = self::HYPHEN_DEFAULT)
	{
		if($hyphens) {
			return $input;
		}
		return str_replace("-", "", $input);
	}

	protected function p2reverseDomain(
		$reverseDomain = self:REVERSE_DOMAIN, $subDomain = self::SUBDOMAIN_DEFAULT)
	{
		// convenience to give unique name variations modify according to preference
		// this MUST return something meaningful as it is used in both functions that use names
		if(is_string($subDomain)) {
			return $reverseDomain . "." . $subDomain;

		} elseif (0 == $subDomain) {
			return $reverseDomain;
		} elseif (1 == $subDomain) {
			$subDomain = self::p2v4uuid();
		} elseif (2 == $subDomain) {
			$subDomain = self::p2randomHex();
		} elseif (3 == $subDomain) {
			$subDomain = microtime();
		}

		return $reverseDomain . "." . $subDomain;
	}

	protected function p2randomHex($length = 32)
	{
		// convenience to give a random hexadecimal string
		$charlist = "0123456789abcdef";
		$listlen = strlen($charlist);
		$result = "";
		for( $i = 0; $i < $length; $i++ ) {
			$result .= $charlist[rand(0, $listlen - 1)];
		}
		return $result;
	}
}
