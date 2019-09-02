<?php


namespace Docplanner\AsyncApiDocBundle\AsyncApi\Document;


class AsyncApiDocument
{
	const ASYNC_API_VERSION = '2.0.0-rc1';

	private $id;

	private $title;

	private $version;

	/** @var ChannelDocument[] */
	private $channels;

	private $messages;

	private $components;

	public function __construct($id, $title)
	{
		$this->id    = $id;
		$this->title = $title;
	}

	public function addChannel(ChannelDocument $channelDocument)
	{
		$this->channels[] = $channelDocument;
	}

	public function getArray()
	{
		return [
			'asyncapi' => self::ASYNC_API_VERSION,
			'id'       => $this->id,
			'info'     => [
				'title'   => $this->title,
				'version' => $this->version ?? 'dev',
			],
			'channels' => iterator_to_array($this->getChannels()),

		];
	}

	private function getChannels()
	{
		foreach ($this->channels as $channel)
		{
			yield $channel->getId() => $channel->getArray();
		}
	}
}


