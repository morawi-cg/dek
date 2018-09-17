<?php

namespace Deko\Model;

class UserList implements \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    private $list = [];

    /**
     * UserList constructor.
     * @param array $users
     */
    public function __construct(array $users = array())
    {
        foreach ($users as $user) {
            $this->add($user);
        }
    }

    /**
     * @param UserList $userList
     * @return void
     */
    public function addList(UserList $userList)
    {
        foreach ($userList->getIterator() as $user) {
            $this->add($user);
        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function add(User $user)
    {
        $this->list[$user->getId()] = $user;
    }

    /**
     * @return void
     */
    public function sortById()
    {
        ksort($this->list);
    }

    /**
     * @return \Iterator
     */
    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->list);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->list);
    }
}
