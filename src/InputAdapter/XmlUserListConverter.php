<?php

namespace Deko\InputAdapter;

use Deko\Model\User;
use Deko\Model\UserList;

class XmlUserListConverter implements UserConverterInterface
{
    /**
     * @param string $data
     * @return UserList
     */
    public function convert(string $data): UserList
    {
        libxml_use_internal_errors(true);
        $xmlObject = simplexml_load_string($data);
        if (!$xmlObject || count(libxml_get_errors()) > 0) {
            libxml_clear_errors();
            throw new \InvalidArgumentException('Unsupported format');
        }

        $userList = new UserList();
        foreach ($xmlObject->xpath("/users/user") as $element) {
            $user = new User(
                (string)$element->userid,
                (string)$element->firstname,
                (string)$element->surname,
                (string)$element->username,
                (string)$element->type,
                new \DateTime((string)$element->lastlogintime)
            );
            $userList->add($user);
        }
        return $userList;
    }
}
