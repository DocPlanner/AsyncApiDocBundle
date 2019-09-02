<?php

namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Channel;

use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageRegistry;

interface ChannelDescriberInterface
{
	public function generateChannelDocuments(ChannelRegistry $channelRegistry, MessageRegistry $messageRegistry, AsyncApiDocument $document);
}
