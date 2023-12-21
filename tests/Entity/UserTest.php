<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function getUser() {
        return new User();
    }
    public function testName()
    {
        $user = $this->getUser();
        $name = "Test name";
        
        $user->setName($name);
        $this->assertEquals($name, $user->getName());
    }
    public function testEmail()
    {
        $user = $this->getUser();
        $name = "wawa@gmail.com";
        
        $user->setEmail($name);
        $this->assertEquals($name, $user->getEmail());
    }
    public function testDefaultAvatar()
    {
        $user = $this->getUser();
        $avatar = "default_avatar.png";
        
        $user->setAvatar($avatar);
        $this->assertEquals($avatar, $user->getAvatar());
    }
    public function testNonDefaultAvatar()
    {
        $user = $this->getUser();
        $avatar = "wawa.jpg";

        
        $user->setAvatar($avatar);
        $this->assertEquals('user/' . $user->getId() . '/' . $avatar, $user->getAvatar());
    }
    public function testPassword()
    {
        $user = $this->getUser();
        $password = "wa";
        
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }
    public function testComments()
    {
        $user = $this->getUser();
        $comment = new Comment;
        $comment->setAuthor($user);

        $user->addComment($comment);


        $this->assertContains($comment, $user->getComments());
    }

}
