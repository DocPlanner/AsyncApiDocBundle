<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message;


use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;

interface MessageDescriberInterface
{
	public function describeMessageDocuments(MessageRegistry $registry, AsyncApiDocument $document);
}
