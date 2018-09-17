<?php

namespace Deko\OutputAdapter;

use JMS\Serializer\SerializerBuilder;
use Deko\Model\UserList;

class JsonUserListDumper implements UserDataFileDumperInterface
{
    /**
     * @param UserList $userList
     * @param string $directory
     */
    public function dump(UserList $userList, string $directory)
    {
        if (!is_dir($directory)) {
            throw new \InvalidArgumentException(sprintf("'%s' is not a valid directory", $directory));
        }

        $serializer = SerializerBuilder::create()
            ->addMetadataDir(__DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "json")
            ->build();
        file_put_contents($directory . DIRECTORY_SEPARATOR . "users.json", $serializer->serialize($userList, "json"));
    }
}
