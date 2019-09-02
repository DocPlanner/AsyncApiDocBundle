<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Document;


class ChannelDocument
{
	/** @var string */
	private $id;

	/** @var PublishOperation */
	private $publishOperation;

	/** @var SubscribeOperation */
	private $subscribeOperation;

	public function __construct(string $id, ?PublishOperation $publishOperation, ?SubscribeOperation $subscribeOperation)
	{
		$this->id                 = $id;
		$this->publishOperation   = $publishOperation;
		$this->subscribeOperation = $subscribeOperation;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getArray()
	{
		$arr = [];

		if($this->publishOperation instanceof PublishOperation)
		{
			$arr['publish'] = $this->publishOperation->toArray();
		}

		if($this->publishOperation instanceof SubscribeOperation)
		{
			$arr['subscribe'] = $this->subscribeOperation->toArray();
		}

		return $arr;
	}
}
