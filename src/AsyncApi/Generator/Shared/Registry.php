<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Shared;


abstract class Registry
{
	private $items = [];

	public function has($key): bool
	{
		return array_key_exists($key, $this->items);
	}

	public function add($key, $object)
	{
		$this->items[$key] = $object;
	}

	public function get($key)
	{
		return $this->items[$key] ?? null;
	}

	public function getAll():array
	{
		return $this->items;
	}
}
