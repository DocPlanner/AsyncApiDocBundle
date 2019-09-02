<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Document;


final class MessageDocument
{
	private $name;
	private $title;
	private $summary;
	private $contentType;
	private $phpClass;
	private $payload = [];

	public function __construct(\ReflectionClass $phpClass)
	{
		$this->phpClass = $phpClass;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name): void
	{
		$this->name = $name;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title): void
	{
		$this->title = $title;
	}

	/**
	 * @param mixed $summary
	 */
	public function setSummary($summary): void
	{
		$this->summary = $summary;
	}

	/**
	 * @param mixed $contentType
	 */
	public function setContentType($contentType): void
	{
		$this->contentType = $contentType;
	}

	/**
	 * @return \ReflectionClass
	 */
	public function getPhpClass(): \ReflectionClass
	{
		return $this->phpClass;
	}

	public function setPayloadSchema(array $payload = [])
	{
		$this->payload = $payload;
	}

	public function toArray(): array
	{
		return [
			'name'    => $this->name ?? '',
			'title'   => $this->title ?? '',
			'summary' => $this->summary ?? '',
			'payload' => [
				'type'       => 'object',
				'properties' => $this->payload,
			],
		];
	}


}
