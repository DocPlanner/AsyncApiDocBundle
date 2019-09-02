<?php

namespace Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\Describer;


use Docplanner\AsyncApiDocBundle\AsyncApi\Annotation\AsyncMessage;
use Docplanner\AsyncApiDocBundle\AsyncApi\Document\AsyncApiDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Document\MessageDocument;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageDescriberInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Message\MessageRegistry;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Payload\PayloadResolverInterface;
use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\Util\ClassExtractor;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class AnnotationMessageDescriber implements MessageDescriberInterface
{
	private $dirs = [];
	private $payloadResolver;
	/**
	 * @var Reader
	 */
	private $annotationReader;

	public function __construct(array $dirs, Reader $annotationReader)
	{
		$this->dirs             = $dirs;
		$this->annotationReader = $annotationReader;
	}

	public function describeMessageDocuments(MessageRegistry $messageRegistry, AsyncApiDocument $document)
	{
		$classes = $this->getClasses();

		foreach ($classes as $class)
		{
			/** @var AsyncMessage $messageAnnotation */
			$messageAnnotation = $this->annotationReader->getClassAnnotation($class, AsyncMessage::class);

			if ($messageAnnotation)
			{
				$message = $this->getOrCreateMessage($class, $messageRegistry);
				$this->describeMessage($message, $class, $messageAnnotation);
			}
		}
	}

	private function describeMessage(MessageDocument $messageDocument, \ReflectionClass $class, AsyncMessage $annotation)
	{
		$messageDocument->setName($annotation->getName() ?? '');
		$messageDocument->setContentType($annotation->getContentType());
		$messageDocument->setSummary($annotation->getSummary());
		$messageDocument->setTitle($annotation->getTitle());
	}

	private function getOrCreateMessage(\ReflectionClass $class, MessageRegistry $messageRegistry): MessageDocument
	{
		if ($messageRegistry->has($class->getName()))
		{
			return $messageRegistry->get($class->getName());
		}

		$message = new MessageDocument($class);
		$messageRegistry->add($class->getName(), $message);

		return $message;
	}

	/**
	 * @return \ReflectionClass[]
	 */
	private function getClasses()
	{
		$finder = new Finder;
		$finder->in($this->dirs)
			->files()
			->name('*.php');

		$classes = [];

		/** @var SplFileInfo $file */
		foreach ($finder as $file)
		{
			$class = ClassExtractor::get_class_from_file($file->getPathname());
			$classes[$class] = new \ReflectionClass($class);
		}

		return array_values($classes);
	}
}
