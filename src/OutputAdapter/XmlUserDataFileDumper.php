<?php

namespace Deko\OutputAdapter;

use JMS\Serializer\SerializerBuilder;
use Deko\Model\UserList;

class XmlUserDataFileDumper implements UserDataFileDumperInterface
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
            ->addMetadataDir(__DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "xml")
            ->build();
        file_put_contents($directory . DIRECTORY_SEPARATOR . "users.xml", $serializer->serialize($userList, 'xml'));
    }
}
