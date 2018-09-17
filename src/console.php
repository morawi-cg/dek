<?php
use Symfony\Component\Console\Application;

require_once(__DIR__ . '/../vendor/autoload.php');

$console = new Application();

$dataProvider = new \Deko\Processor\MultiFileUserListProvider();
$dataProvider->registerAdapter("json", new \Deko\InputAdapter\JsonUserListConverter());
$dataProvider->registerAdapter("xml", new \Deko\InputAdapter\XmlUserListConverter());
$dataProvider->registerAdapter("csv", new \Deko\InputAdapter\CsvUserListConverter());

$dumper = new \Deko\OutputAdapter\CompositeDumper();
$dumper->addDumper(new \Deko\OutputAdapter\MySqlDumper());

$console->add(
    new \Deko\Command\UserConverterCommand(
        $dataProvider,
        $dumper
    )
);
$console->run();
