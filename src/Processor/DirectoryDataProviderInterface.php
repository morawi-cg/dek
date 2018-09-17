<?php

namespace Deko\Processor;

use Deko\Model\UserList;

interface DirectoryDataProviderInterface
{
    /**
     * @param string $path
     * @return UserList
     */
    public function read(string $path): UserList;
}
