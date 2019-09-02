<?php

namespace Docplanner\AsyncApiDocBundle\Command;

use Docplanner\AsyncApiDocBundle\AsyncApi\Generator\GeneratorList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class AsyncApiDumpCommand extends Command
{
	const NAME = 'async-api:dump';
	/**
	 * @var GeneratorList
	 */
	private $generatorList;

	public function __construct(GeneratorList $generatorList)
	{
		parent::__construct(self::NAME);
		$this->generatorList = $generatorList;
	}

	protected function configure()
	{
		$this->addArgument('generator', InputArgument::REQUIRED, 'Generator id');
		$this->addOption('output', null, InputOption::VALUE_REQUIRED, 'Dump output', 'stdout://');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$generator = $this->generatorList->getGenerator($input->getArgument('generator'));

		$doc = $generator->generateAsyncApiDocument();

		$arr = $doc->getArray();

		$output->writeln(Yaml::dump($arr, 5));
	}
}
