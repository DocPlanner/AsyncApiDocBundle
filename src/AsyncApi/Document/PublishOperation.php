<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Document;


class PublishOperation
{
	/** @var string */
	private $operationId;

	/** @var string */
	private $summary;

	/** @var MessageDocument */
	private $message;
	/**
	 * @var string
	 */
	private $rabbitExchange;
	/**
	 * @var string
	 */
	private $rabbitRoutingKey;

	public function __construct(string $operationId, string $summary, MessageDocument $message)
	{
		$this->operationId = $operationId;
		$this->summary     = $summary;
		$this->message     = $message;
	}

	public function rabbitExtension(string $exchange, string $routingKey)
	{
		$this->rabbitExchange   = $exchange;
		$this->rabbitRoutingKey = $routingKey;
	}

	public function toArray()
	{
		return [
			'operationId'            => $this->operationId,
			'summary'                => $this->summary,
			'message'                => $this->message->toArray(),
			'x-rabbitmq-exchange'    => $this->rabbitExchange,
			'x-rabbitmq-routing-key' => $this->rabbitRoutingKey,
		];
	}
}
