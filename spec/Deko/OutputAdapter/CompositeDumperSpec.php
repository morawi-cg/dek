<?php

namespace spec\Deko\OutputAdapter;

use Deko\Model\UserList;
use Deko\OutputAdapter\CompositeDumper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Deko\OutputAdapter\UserDataFileDumperInterface;

/**
 * Class CompositeDumperSpec
 * @package spec\Deko\OutputAdapter
 * @mixin CompositeDumper
 */
class CompositeDumperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CompositeDumper::class);
    }

    public function it_calls_all_registered_dumpers(UserDataFileDumperInterface $dumper1, UserDataFileDumperInterface $dumper2)
    {
        $this->addDumper($dumper1);
        $this->addDumper($dumper2);

        $userList = new UserList();
        $directory = "";
        $this->dump($userList, $directory);
        $dumper1->dump($userList, $directory)->shouldHaveBeenCalled();
        $dumper2->dump($userList, $directory)->shouldHaveBeenCalled();
    }
}
