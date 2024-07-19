<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Groupe;
use App\Entity\Comment;
use App\Form\TrickType;
use App\Form\CommentType;
use App\DataFixtures\TrickFixture;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
#[Route('/tricks')]
class TrickController extends AbstractController
{
    // #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    // public function index(TrickRepository $trickRepository): Response
    // {
    //     $card = [
    //         'user'=>[
    //             'title'=>'track',
    //             'avatar' => 'https://placehold.co/60x60'
    //         ],
    //         'content' => 'blabla bonjour',
    //         'image' => 'https://placehold.co/600x400'
    //     ];
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'card' => $card,
    //     ]);
    //     // return $this->render('trick/index.html.twig', [
    //     //     'tricks' => $trickRepository->findAll(),
    //     // ]);
    // }

    #[Route('/new', name: 'app_trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $videolinks = $form->get('videos')->getData();
            // if ($videolinks) {
            //     foreach($videolinks as $video) {
            //         $vid = new Video();
            //         $vid->setUrl($video);
            //         $vid->setTrick($trick);
            //         $entityManager->persist($vid);

            //         $trick->addVideo($vid);
            //     }
            // }


            $entityManager->persist($trick);

            $entityManager->flush();



            $photosFiles = $form->get('photos')->getData();
            // $groupe = $form->get('groupe')->getData();

            // if($groupe) {
            //     $groupe = strtolower($groupe);
            //     $groupeRepository = $entityManager->getRepository(Groupe::class);
            //     $group = $groupeRepository->findBy(['name' => $groupe]);

            //     if($group) {
            //         $trick->setGroupe($group[0]);
            //     } else {
            //         $group = new Groupe();
            //         $group->setName($groupe);
            //         $entityManager->persist($group);

            //         $trick->setGroupe($group);
            //     }
            // }

            if ($photosFiles) {
                $filesystem = new Filesystem();
                $dir = __DIR__.'/../../public/img/trick/'.$trick->getId();
                try {
                    $filesystem->mkdir(
                        $dir, 0700
                    );
                } catch (IOExceptionInterface $exception) {
                    echo "An error occurred while creating your directory at ".$exception->getPath();
                }


                foreach ($photosFiles as $photo) { 
                    $filename = uniqid().'.'.$photo->guessExtension();
                    try {
                        $photo->move(
                            $dir,
                            $filename
                        );


                        $img = new Photo();
                        $img->setUrl($filename);
                        $img->setTrick($trick);

                        $entityManager->persist($img);

                        $trick->addPhoto($img);
                    } catch (FileException $e) {
                        echo 'Erreur dans l\'envoi de l\'image';
                    }
                }
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Nouveau trick enregistré'
                );
            }

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }



        return $this->renderForm('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_trick_show', methods: ['GET'])]
    public function show(Trick $trick, CommentRepository $commentRepository): Response
    {

        $commentform = $this->createForm(CommentType::class);
        $commentform = $commentform->createView();
        $comments = $commentRepository->findBy(['trick' => $trick], ['id'=> 'DESC'], 10);

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'commentform' => $commentform,
            'comments' => $comments,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, EntityManagerInterface $entityManager): Response
    {
        $oldPhotos = $trick->getPhotos();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photosFiles = $form->get('photos')->getData();
            foreach($oldPhotos as $photo) {
                $trick->addPhoto($photo);
            }
            if ($photosFiles) {
                $filesystem = new Filesystem();
                $dir = __DIR__.'/../../public/img/trick/'.$trick->getId();
                try {
                    $filesystem->mkdir(
                        $dir, 0700
                    );
                } catch (IOExceptionInterface $exception) {
                    echo "An error occurred while creating your directory at ".$exception->getPath();
                }


                foreach ($photosFiles as $photo) { 
                    $filename = uniqid().'.'.$photo->guessExtension();
                    try {
                        $photo->move(
                            $dir,
                            $filename
                        );


                        $img = new Photo();
                        $img->setUrl($filename);
                        $img->setTrick($trick);

                        $entityManager->persist($img);

                        $trick->addPhoto($img);
                    } catch (FileException $e) {
                        echo 'Erreur dans l\'envoi de l\'image';
                    }
                }
            }

            $entityManager->flush();
            $this->addFlash(
                'success',
                'Trick modifié'
            );

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'photos' => $oldPhotos,
        ]);
    }

    #[Route('/{id}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/api/deletePhoto/{id}', name: 'app_photo_delete', methods: ['GET'])]
    public function deletephoto(Request $request, Photo $photo, EntityManagerInterface $entityManager): Bool
    {
        $entityManager->remove($photo);
        $entityManager->flush();

        return true;

    }

}
