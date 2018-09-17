<?php

namespace Deko\OutputAdapter;

use Deko\Model\User;
use Deko\Model\UserList;

class MySqlDumper implements UserDataFileDumperInterface
{
    private const MYSQL_USERNAME = "mysqluser";
    private const MYSQL_PASSWORD = "mysqlpasswd";
    private const MYSQL_HOST = "localhost";
    private const MYSQL_PORT = 3306;
    private const MYSQL_DBNAME = "users";

    /** @var \PDO */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            sprintf("mysql:dbname=%s;host=%s;port=%d", self::MYSQL_DBNAME, self::MYSQL_HOST, self::MYSQL_PORT),
            self::MYSQL_USERNAME,
            self::MYSQL_PASSWORD
        );
    }

    public function dump(UserList $userList, string $directory)
    {
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $statement = $this->pdo->prepare(
            "INSERT INTO userdata (`userid`, `firstname`, `surname`, `type`, `lastlogintime`)
            VALUES (:userid, :firstname, :surname, :type, :lastlogintime)"
        );
        $this->pdo->beginTransaction();
        /** @var User $user */
        foreach ($userList->getIterator() as $user) {
            $statement->execute([
                'userid' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'surname' => $user->getLastname(),
                'type' => $user->getType(),
                'lastlogintime' => $user->getLastLogin()->format("Y-m-d H:i:s")
            ]);
        }
        $this->pdo->commit();
    }
}
