<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator;

use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Channel\ChannelDescriberInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Channel\ChannelRegistry;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageDescriberInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageRegistry;

class DocumentGenerator
{
	private $id;

	private $name;

	private $channelGenerator;

	private $messageGenerator;

	public function __construct($id, $name, ChannelDescriberInterface $channelGenerator, MessageDescriberInterface $messageGenerator)
	{
		$this->id               = $id;
		$this->name             = $name;
		$this->channelGenerator = $channelGenerator;
		$this->messageGenerator = $messageGenerator;
	}

	public function generateAsyncApiDocument(): AsyncApiDocument
	{
		$document        = new AsyncApiDocument($this->id, $this->name, date(DATE_ISO8601));
		$messageRegistry = new MessageRegistry;
		$channelRegistry = new ChannelRegistry;

		$this->messageGenerator->describeMessageDocuments($messageRegistry, $document);
		$this->channelGenerator->generateChannelDocuments($channelRegistry, $messageRegistry, $document);

		return $document;
	}
}
