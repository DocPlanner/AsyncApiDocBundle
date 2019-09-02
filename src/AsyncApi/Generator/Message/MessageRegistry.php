<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message;


use Docplanner\AsyncApiDocBundle\AsyncApi\Document\MessageDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Shared\Registry;

class MessageRegistry extends Registry
{
	public function has($key): bool
	{
		return parent::has($key);
	}

	public function add($key, $object)
	{
		parent::add($key, $object);
	}

	public function get($key): MessageDocument
	{
		return parent::get($key);
	}

	/**
	 * @return MessageDocument[]
	 */
	public function getAll():array
	{
		return parent::getAll();
	}

}
