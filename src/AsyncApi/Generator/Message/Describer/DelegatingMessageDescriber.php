<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\Describer;


use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageDescriberInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageRegistry;

class DelegatingMessageDescriber implements MessageDescriberInterface
{
	/** @var MessageDescriberInterface[] */
	private $messageDescribers = [];

	public function __construct(...$messageDescribers)
	{
		$this->messageDescribers = $messageDescribers;
	}


	public function describeMessageDocuments(MessageRegistry $registry, AsyncApiDocument $document)
	{
		foreach($this->messageDescribers as $messageDescriber)
		{
			$messageDescriber->describeMessageDocuments($registry, $document);
		}
	}
}
