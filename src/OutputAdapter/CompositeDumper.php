<?php

namespace Deko\OutputAdapter;

use Deko\Model\UserList;

class CompositeDumper implements UserDataFileDumperInterface
{
    /**
     * @var array
     */
    private $dumpers = [];

    public function addDumper(UserDataFileDumperInterface $dumper)
    {
        $this->dumpers[] = $dumper;
    }

    public function dump(UserList $userList, string $directory)
    {
        /** @var UserDataFileDumperInterface $dumper */
        foreach ($this->dumpers as $dumper) {
            $dumper->dump($userList, $directory);
        }
    }
}
