<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnonceController extends AbstractController
{
    #[Route('/ads', name: 'app_ads')]
    public function index(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }

//    #[Route(
//        path: '/ads/{id}/publication',
//        name: 'ads_post_publication',
//        defaults: [
//            '_api_resource_class' => Annonce::class,
//            '_api_operation_name' => '_api_/ads/{id}/publication_post',
//        ],
//        methods: ['POST', 'GET'],
//    )]
//    public function __invoke(annonce $annonce): annonce
//    {
//        $this->annonce->handle($annonce);
//
//        return $annonce;
//    }
}
