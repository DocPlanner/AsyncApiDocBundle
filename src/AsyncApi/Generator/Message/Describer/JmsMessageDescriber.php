<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\Describer;


use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Document\MessageDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageDescriberInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageRegistry;
use Docplanner\MainBundle\Utils\Inflector;
use Nelmio\ApiDocBundle\Parser\JmsMetadataParser;
use phpDocumentor\Reflection\DocBlock;

class JmsMessageDescriber implements MessageDescriberInterface
{
	private $jmsMetadataParser;

	public function __construct(JmsMetadataParser $jmsMetadataParser)
	{
		$this->jmsMetadataParser = $jmsMetadataParser;
	}


	public function describeMessageDocuments(MessageRegistry $registry, AsyncApiDocument $document)
	{
		foreach ($registry->getAll() as $messageDocument)
		{
			$meta = $this->jmsMetadataParser->parse([
				'class'  => $messageDocument->getPhpClass()->getName(),
				'groups' => [],
			]);


			$meta          = $this->generateExample($messageDocument, $meta);
			$payloadSchema = $this->generatePayloadFromMeta($meta);
			$messageDocument->setPayloadSchema($payloadSchema);
		}
	}

	private function generatePayloadFromMeta(array $meta)
	{
		$schema = [];

		foreach ($meta as $field => $def)
		{
			$schema[$field] = [
				'type'        => $def['dataType'],
				'description' => $def['description'],
				'example'     => $def['example'] ?? '',
			];
		}

		return $schema;
	}

	private function generateExample(MessageDocument $messageDocument, array $meta)
	{
		foreach ($meta as $field => &$def)
		{
			$field = Inflector::variable($field);
			$reflection = $messageDocument->getPhpClass()->getProperty($field);
			$doc        = new DocBlock($reflection);
			$tags       = $doc->getTagsByName('example');

			$def['example'] = !empty($tags[0]) ? $tags[0]->getContent() : '';
		}

		return $meta;
	}
}
