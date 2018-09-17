<?php

namespace Deko\InputAdapter;

use Deko\Model\User;
use Deko\Model\UserList;

class CsvUserListConverter implements UserConverterInterface
{

    /**
     * @param string $data
     * @return UserList
     */
    public function convert(string $data): UserList
    {
        $userData = array_map("str_getcsv", explode(PHP_EOL, $data));
        $header = array_shift($userData);
        if (count($header) != 6) {
            throw new \InvalidArgumentException("Unsupported format");
        }
        $userList = new UserList();
        foreach ($userData as $userLine) {
            if (count($userLine) != 6) {
                continue;
            }
            $user = new User(
                (string)$userLine[0],
                (string)$userLine[1],
                (string)$userLine[2],
                (string)$userLine[3],
                (string)$userLine[4],
                new \DateTime((string)$userLine[5])
            );
            $userList->add($user);
        }
        return $userList;
    }
}
