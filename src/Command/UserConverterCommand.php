<?php

namespace Deko\Command;

use Deko\OutputAdapter\UserDataFileDumperInterface;
use Deko\Processor\DirectoryDataProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserConverterCommand extends Command
{
    /**
     * @var DirectoryDataProviderInterface
     */
    private $dataProvider;
    /**
     * @var UserDataFileDumperInterface
     */
    private $dumper;

    /**
     * UserConverterCommand constructor.
     * @param DirectoryDataProviderInterface $dataProvider
     * @param UserDataFileDumperInterface $dumper
     */
    public function __construct(DirectoryDataProviderInterface $dataProvider, UserDataFileDumperInterface $dumper)
    {
        $this->dataProvider = $dataProvider;
        $this->dumper = $dumper;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('deko:user-file-converter')
            ->setDescription('Test converter')
            ->addOption("inputDirectory", null, InputOption::VALUE_REQUIRED, 'Location of input files')
            ->addOption("outputDirectory", null, InputOption::VALUE_OPTIONAL, 'Target directory', "");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dumper->dump(
            $this->dataProvider->read($input->getOption("inputDirectory")),
            $input->getOption("outputDirectory")
        );
    }
}
