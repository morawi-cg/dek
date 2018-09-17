<?php

namespace Deko\InputAdapter;

use Deko\Model\User;
use Deko\Model\UserList;

class JsonUserListConverter implements UserConverterInterface
{
    /**
     * @param string $data
     * @return UserList
     */
    public function convert(string $data): UserList
    {
        $jsonObject = json_decode($data);
        if ($jsonObject === null) {
            throw new \InvalidArgumentException("Unsupported format");
        }

        $userList = new UserList();
        foreach ($jsonObject as $userData) {
            $user = new User(
                (string)$userData->user_id,
                (string)$userData->first_name,
                (string)$userData->last_name,
                (string)$userData->username,
                (string)$userData->user_type,
                new \DateTime((string)$userData->last_login_time)
            );
            $userList->add($user);
        }
        return $userList;
    }
}
