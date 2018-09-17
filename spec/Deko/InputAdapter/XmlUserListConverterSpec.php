<?php

namespace spec\Deko\InputAdapter;

use Deko\InputAdapter\XmlUserListConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Deko\Model\UserList;

/**
 * Class XmlUserListConverterSpec
 * @package spec\Deko\InputAdapter
 * @mixin XmlUserListConverter
 */
class XmlUserListConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XmlUserListConverter::class);
    }

    public function it_rejects_invalid_xml()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during("convert", ["invalid xml!"]);
    }

    public function it_returns_a_userlist_on_valid_input()
    {
        $valid = '<?xml version="1.0" encoding="utf-8"?>
            <users>
                <user>
                    <userid>1</userid>
                    <firstname>2</firstname>
                    <surname>3</surname>
                    <username>4</username>
                    <type>5</type>
                    <lastlogintime>05-05-2017 12:12:12</lastlogintime>
                </user>
            </users>
        ';

        $this->convert($valid)->shouldHaveType(UserList::class);
    }
}
