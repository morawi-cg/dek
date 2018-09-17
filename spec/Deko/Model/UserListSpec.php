<?php

namespace spec\Deko\Model;

use Deko\Model\User;
use Deko\Model\UserList;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UserListSpec
 * @package spec\Deko\Model
 * @mixin UserList
 */
class UserListSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UserList::class);
    }

    public function it_can_add_users_to_the_list()
    {
        $this->count()->shouldBe(0);
        $this->add(new User(1,2,3,4,5, new \DateTime()));
        $this->count()->shouldBe(1);
    }

    public function it_can_sort_the_list_by_id()
    {
        $this->add(new User(2,3,4,5,6, new \DateTime()));
        $this->add(new User(1,2,3,4,5, new \DateTime()));
        $iterator = $this->getIterator();
        $iterator->rewind();
        $iterator->current()->getId()->shouldBe(2);
        $iterator->next();
        $iterator->current()->getId()->shouldBe(1);

        $this->sortById();

        $iterator = $this->getIterator();
        $iterator->rewind();
        $iterator->current()->getId()->shouldBe(1);
        $iterator->next();
        $iterator->current()->getId()->shouldBe(2);
    }

    public function it_can_add_users_from_another_list_to_this_list()
    {
        $this->add(new User(1,2,3,4,5, new \DateTime()));
        $this->count()->shouldBe(1);

        $otherList = new UserList();
        $otherList->add(new User(2,3,4,5,6, new \DateTime()));

        $this->addList($otherList);

        $this->count()->shouldBe(2);
    }
}
