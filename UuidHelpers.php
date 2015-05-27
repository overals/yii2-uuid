<?php
namespace p2made\Uuid;

use yii;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

/*
	UuidHelpers::p2uuid1()
	UuidHelpers::p2uuid3('mfa_test')
	UuidHelpers::p2uuid4()
	UuidHelpers::p2uuid5('mfa_test')
*/

class UuidHelpers
{
	const REVERSE_DOMAIN = 'com.myfestivalsapp';

	const SUBDOMAIN_UUID = 1;	// UUID as subdomain.
	const SUBDOMAIN_RAND = 2;	// Random hex as subdomain.
	const SUBDOMAIN_TIME = 3;	// microtime() as subdomain.
	const SUBDOMAIN_NONE = 0;	// NO subdomain.
	const SUBDOMAIN_DEFAULT = 1;

	public static function uuid($subDomain)
	{
		return self::p2uuid5($subDomain);
	}

	public static function p2uuid1()
	{
		return Uuid::uuid1();
	}

	public static function p2uuid3($subDomain = self::SUBDOMAIN_UUID)
	{
		return Uuid::uuid3(Uuid::uuid1(), self::p2reverseDomain($subDomain));
	}

	public static function p2uuid4()
	{
		return Uuid::uuid4();
	}

	public static function p2uuid5($subDomain = self::SUBDOMAIN_UUID)
	{
		return Uuid::uuid5(Uuid::uuid4(), self::p2reverseDomain($subDomain));
	}

	protected static function p2reverseDomain($subDomain = self::SUBDOMAIN_UUID)
	{
		// convenience to give unique name variations modify according to preference
		// this MUST return something meaningful as it is used in both functions that use names

		if(!is_string($subDomain)) {
			return self::REVERSE_DOMAIN . '.' . $subDomain;
		} elseif(self::SUBDOMAIN_NONE == $subDomain) {
			return self::REVERSE_DOMAIN;
		} elseif(self::SUBDOMAIN_UUID == $subDomain) {
			$subDomain = self::p2uuid4();
		} elseif(self::SUBDOMAIN_RAND == $subDomain) {
			$subDomain = self::p2randomHex();
		} elseif(self::SUBDOMAIN_TIME == $subDomain) {
			$subDomain = microtime();
		}

		return self::REVERSE_DOMAIN . '.' . $subDomain;
	}

	private static function p2randomHex($length = 32)
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
