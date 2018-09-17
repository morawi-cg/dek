<?php

namespace Deko\OutputAdapter;

use JMS\Serializer\SerializerBuilder;
use Deko\Model\UserList;

class CsvUserDataFileDumper implements UserDataFileDumperInterface
{
    public function dump(UserList $userList, string $directory)
    {
        if (!is_dir($directory)) {
            throw new \InvalidArgumentException(sprintf("'%s' is not a valid directory", $directory));
        }

        $serializer = SerializerBuilder::create()
            ->addMetadataDir(__DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "csv")
            ->build();
        $serialized = $serializer->toArray($userList);

        $filePointer = fopen($directory . DIRECTORY_SEPARATOR . "users.csv", "w");
        fputcsv($filePointer, array_keys($serialized[0]));
        foreach ($serialized as $userLine) {
            fputcsv($filePointer, $userLine);
        }
        fclose($filePointer);
    }
}
