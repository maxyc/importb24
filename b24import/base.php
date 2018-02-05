<?php
/**
 * Maxyc Webber
 * maxycws@gmail.com
 */

namespace B24Import;
use Curl\Curl;


class Base
{
	private $curl;
	private $url;
	private $result;

	/**
	 * @return mixed
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * @param mixed $result
	 */
	public function setResult($type, $result)
	{
		$this->result[$type][] = $result;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return Curl
	 */
	public function getCurl()
	{
		return $this->curl;
	}

	/**
	 * @param Curl $curl
	 */
	public function setCurl($curl)
	{
		$this->curl = $curl;
	}

	public function __construct()
	{
		$this->setCurl(new Curl());
	}

	protected function query($action, $data)
	{
		return $this->curl->get($this->getUrl().$action.'/', $data);
	}
}