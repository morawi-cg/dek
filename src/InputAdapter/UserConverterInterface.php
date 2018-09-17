<?php

namespace Deko\InputAdapter;

use Deko\Model\UserList;

interface UserConverterInterface
{
    /**
     * @param string $data
     * @return UserList
     */
    public function convert(string $data): UserList;
}
