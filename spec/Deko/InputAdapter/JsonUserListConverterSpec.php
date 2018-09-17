<?php

namespace spec\Deko\InputAdapter;

use Deko\InputAdapter\JsonUserListConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Deko\Model\UserList;

/**
 * Class JsonUserListConverterSpec
 * @package spec\Deko\InputAdapter
 * @mixin JsonUserListConverter
 */
class JsonUserListConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(JsonUserListConverter::class);
    }

    public function it_rejects_invalid_json()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during("convert", ["invalid json!"]);
    }

    public function it_returns_a_userlist_on_valid_input()
    {
        $valid = '[
            {
                "user_id": "1",
                "first_name": "2",
                "last_name": "3",
                "username": "4",
                "user_type": "5",
                "last_login_time": "05-05-2017 11:11:11"
            }
        ]';

        $this->convert($valid)->shouldHaveType(UserList::class);
    }
}
