<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Annotation;

/**
 * @Annotation
 */
class AsyncMessage
{
	/** @var string */
	private $name;

	/** @var string */
	private $title;

	/** @var string */
	private $summary;

	/** @var string */
	private $contentType;

	public function __construct(array $data = [])
	{
		foreach ($data as $name => $value)
		{
			if (!property_exists($this, $name))
			{
				throw new \InvalidArgumentException("Annotation does not have property {$name}");
			}

			$this->{$name} = $value;
		}
	}


	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getSummary()
	{
		return $this->summary;
	}

	/**
	 * @return mixed
	 */
	public function getContentType()
	{
		return $this->contentType;
	}


}
