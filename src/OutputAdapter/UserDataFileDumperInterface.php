<?php

namespace Deko\OutputAdapter;

use Deko\Model\UserList;

interface UserDataFileDumperInterface
{
    /**
     * @param UserList $userList
     * @param string $directory
     * @return void
     */
    public function dump(UserList $userList, string $directory);
}
