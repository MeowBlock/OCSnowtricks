<?php
namespace App\Tests\Validator;

use App\Entity\Video;
use App\Validator\VideoAssert;
use App\Validator\VideoValidator;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class VideoValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): VideoValidator
    {
        return new VideoValidator();
    }

    public function testNullIsValid(): void
    {
        $this->validator->validate(new Video(), new VideoAssert());

        $this->assertNoViolation();
    }

    public function testTrueIsInvalid(): void
    {
        $video = new Video();
        $invalid_url = 'wawa';
        $video->setUrl($invalid_url);
        $constraint = new VideoAssert();
        $this->validator->validate($video, $constraint);

        $this->buildViolation($constraint->messageLien)
            ->setParameter('{{ value }}', $invalid_url)
            ->assertRaised();
    }
    public function testTrueIsValid(): void
    {
        $video = new Video();
        $valid_url = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
        $video->setUrl($valid_url);
        $constraint = new VideoAssert();
        $this->validator->validate($video, $constraint);

        $this->assertNoViolation();

    }
    public function TestCorrectLinkNoVideo(): void
    {
        $video = new Video();
        $valid_url = 'https://www.youtube.com/watch?v=smiledQw4w9WgXcQ';
        $video->setUrl($valid_url);
        $constraint = new VideoAssert();
        $this->validator->validate($video, $constraint);

        $this->assertNoViolation();

    }
    public function testSetUrlReplace(): void
    {
        $video = new Video();
        $invalid_url = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&list=RDdQw4w9WgXcQ&start_radio=1&rv=dQw4w9WgXcQ&t=2';
        $video->setUrl($invalid_url);
        $constraint = new VideoAssert();
        $this->validator->validate($video, $constraint);

        $this->assertNoViolation();

    }
}