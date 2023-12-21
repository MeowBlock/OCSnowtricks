<?php

namespace App\Validator;

use App\Entity\Video;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class VideoValidator extends ConstraintValidator
{
    public function validate($video, Constraint $constraint)
    {
        if (!$constraint instanceof VideoAssert) {
            throw new UnexpectedTypeException($constraint, VideoValidator::class);
        }
        if (!$video instanceof Video) {
            throw new UnexpectedTypeException($video, Video::class);
        }

        $url = $video->getUrl();


        if (null === $url || '' === $url) {
            return;
        }

        /**
         * @var VideoAssert $constraint
         */
        if(!preg_match('/https?:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9]*/', $url)) {
            $this->context->buildViolation($constraint->messageLien)
                ->setParameter('{{ value }}', $url)
                ->addViolation();
        } else {
            $curl = HttpClient::create();
            $response = $curl->request(
                'GET',
                $url
            );
            //youtube stupide retourne 200 meme si video n'existe pas
            if($response->getStatusCode() != 200) {
                $this->context->buildViolation($constraint->messageVideo)
                    ->setParameter('{{ value }}', $url)
                    ->addViolation();
            }
        }




    }
}