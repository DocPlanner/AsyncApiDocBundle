<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator;


use Docplanner\AsyncApiDocBundle\AsyncApi\Exception\RuntimeException;

class GeneratorList
{
	/** @var DocumentGenerator[] */
	private $generators = [];

	public function addGenerator($id, DocumentGenerator $generator)
	{
		$this->generators[$id] = $generator;
	}

	public function getGenerator($id): DocumentGenerator
	{
		if (empty($this->generators[$id]))
		{
			throw new RuntimeException("Not found document generator by id: {$id}");
		}

		return $this->generators[$id];
	}
}
