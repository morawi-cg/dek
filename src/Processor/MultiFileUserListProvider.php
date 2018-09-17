<?php

namespace Deko\Processor;

use Deko\InputAdapter\UserConverterInterface;
use Deko\Model\UserList;

class MultiFileUserListProvider implements DirectoryDataProviderInterface
{
    /**
     * @var array
     */
    private $inputAdapters = [];

    public function registerAdapter(string $type, UserConverterInterface $converter)
    {
        $this->inputAdapters[$type] = $converter;
    }

    public function read(string $path): UserList
    {
        $directory = new \DirectoryIterator($path);
        $userList = new UserList();
        foreach ($directory as $file) {
            if (!$file->isDot()) {
                $adapter = $this->getAdapterFor($file->getExtension());
                $userList->addList($adapter->convert(file_get_contents($file->getPathname())));
            }
        }
        return $userList;
    }

    /**
     * @param string $type
     * @return UserConverterInterface
     * @throws \Exception
     */
    private function getAdapterFor(string $type)
    {
        if (!array_key_exists($type, $this->inputAdapters)) {
            throw new \Exception(sprintf("No plugin found for '%s'", $type));
        }
        return $this->inputAdapters[$type];
    }
}
