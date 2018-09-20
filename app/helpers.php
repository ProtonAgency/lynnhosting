<?php

if(!function_exists('generate_password'))
{
	function generate_password($len = 16)
	{
		return substr(bin2hex(random_bytes(36)), 0, $len);
	}
}

if(!function_exists('generate_name'))
{
	function generate_name()
	{
		$name = uniqid();
		return substr(md5($name), 0, strlen($name));
	}
}

if(!function_exists('generate_hash'))
{
	function generate_hash()
	{
		return md5(uniqid());
	}
}

if(!function_exists('generate_location_url'))
{
	function generate_location_url($name)
	{
		return strtolower(str_replace('-', '', $name)) . '.lynnhosting.com';
	}
}