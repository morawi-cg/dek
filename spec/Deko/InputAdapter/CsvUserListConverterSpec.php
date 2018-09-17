<?php

namespace spec\Deko\InputAdapter;

use Deko\InputAdapter\CsvUserListConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Deko\Model\UserList;

/**
 * Class CsvUserListConverterSpec
 * @package spec\Deko\InputAdapter
 * @mixin CsvUserListConverter
 */
class CsvUserListConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CsvUserListConverter::class);
    }

    public function it_rejects_invalid_csv()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during("convert", ["invalid csv!"]);
    }

    public function it_returns_a_userlist_on_valid_input()
    {
        $valid = 'User ID,First Name,Last Name,Username,User Type,Last Login Time
1,2,3,4,5,05-05-2017 11:11:11';

        $this->convert($valid)->shouldHaveType(UserList::class);
    }
}
