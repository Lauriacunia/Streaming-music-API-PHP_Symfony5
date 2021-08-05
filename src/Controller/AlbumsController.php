<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Artists;
use App\Entity\Tracks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumsController extends AbstractController
{
    /**
     * @Route("/albums", name="albums")
     */
    public function index(): Response
    {
        $album = new Albums();
        $album->setName('Pies Descalzos');
        $album->setGenres(['rock', 'pop']);
        $album->setReleaseDate(new \DateTime('2016-01-01'));
        $album->setImage("laUrlCover");

        $artist = new Artists();
        $artist->setName('Shakira');

        $track1 = new Tracks();
        $track1->setName('¿Donde estas corazon?');

        $track2 = new Tracks();
        $track2->setName('Ciega, sordomuda');
        $track3 = new Tracks();
        $track3->setName('Estoy aqui');

        $album->addArtist($artist);
        $album->addTrack($track1);
        $album->addTrack($track2);
        $album->addTrack($track3);

        $artist->addTrack($track1);
        $artist->addTrack($track2);
        $artist->addTrack($track3);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($album);
        $entityManager->flush();
        
        return new Response(
            'Saved new entity: '.$album->getId().$album->getName()
            
        );
    }
}
