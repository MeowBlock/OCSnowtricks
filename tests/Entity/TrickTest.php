<?php 

namespace App\tests\Entity;
use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Article;
use App\Entity\Comment;
use App\Validator\VideoAssert;
use App\Validator\VideoValidator;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{

    public function getTrick() {
        return new Trick();
    }
    public function testName()
    {
        $trick = $this->getTrick();
        $name = "Test name";
        
        $trick->setName($name);
        $this->assertEquals($name, $trick->getName());
    }
    public function testContent()
    {
        $trick = $this->getTrick();
        $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        
        $trick->setContent($content);
        $this->assertEquals($content, $trick->getContent());
    }
    public function testCreatedAt()
    {
        $trick = $this->getTrick();
        $createdAt = new \DateTimeImmutable;
        
        $trick->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $trick->getCreatedAt());
    }
    public function testLastModified()
    {
        $trick = $this->getTrick();
        $last_modified = new \DateTimeImmutable();
        
        $trick->setLastModified($last_modified);
        $this->assertEquals($last_modified, $trick->getLastModified());
    }
    public function testPhoto()
    {
        $trick = $this->getTrick();
        $photo = new Photo();
        $photo_url1 = 'teststring';
        $photo_url2 = 'test2';
        $photo->setUrl($photo_url1);

        $trick->addPhoto($photo);

        $photo->setUrl($photo_url2);
        $this->assertCount(1, $trick->getPhotos());
        $this->assertEquals($photo, $trick->getPhotos()[0]);
        $this->assertEquals($photo_url2, $trick->getPhotos()[0]->getUrl());
    }
    public function testPhotoArray()
    {
        $trick = $this->getTrick();
        $photo1 = new Photo();
        $photo2 = new Photo();
        $photo_url1 = 'teststring';
        $photo_url2 = 'test2';
        $photo1->setUrl($photo_url1);
        $photo2->setUrl($photo_url2);

        $trick->addPhoto($photo1);
        $trick->addPhoto($photo2);

        $this->assertCount(2, $trick->getPhotos());
        $this->assertContains($photo1, $trick->getPhotos());
        $this->assertContains($photo2, $trick->getPhotos());
    }

    public function testVideo()
    {
        $trick = $this->getTrick();
        $video = new Video();
        $video_url1 = 'teststring';
        $video_url2 = 'test2';
        $video->setUrl($video_url1);

        $trick->addVideo($video);

        $video->setUrl($video_url2);

        $this->assertEquals($video, $trick->getVideos()[0]);
        $this->assertEquals($video_url2, $trick->getVideos()[0]->getUrl());
    }
    public function testVideoArray()
    {
        $trick = $this->getTrick();
        $video1 = new Video;
        $video2 = new Video;
        $video_url1 = 'teststring';
        $video_url2 = 'test2';
        $video1->setUrl($video_url1);
        $video2->setUrl($video_url2);

        $trick->addVideo($video1);
        $trick->addVideo($video2);


        $this->assertContains($video1, $trick->getVideos());
        $this->assertContains($video2, $trick->getVideos());
    }

    public function testComments()
    {
        $trick = $this->getTrick();
        $comment = new Comment;
        $comment->setTrick($trick);

        $trick->addComment($comment);


        $this->assertContains($comment, $trick->getComments());
    }
}