<?php

namespace App\Controller;

use App\Entity\LinkVisit;
use App\Repository\LinkRepository;
use App\Repository\LinkVisitRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LinkController extends AbstractController
{
    private LinkRepository $linkRepository;
    private LinkVisitRepository $linkVisitRepository;

    public function __construct(LinkRepository $linkRepository, LinkVisitRepository $linkVisitRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->linkVisitRepository = $linkVisitRepository;
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/r/{slug}', name: 'link.resolve')]
    public function resolve(string $slug): RedirectResponse | Response
    {
        $link = $this->linkRepository->findOneBySlug($slug);

        if ($link) {
            $this->linkVisitRepository->createLinkVisit($link);
            return $this->redirect($link->getUrl());
        } else {
            return new Response('URL not found', 404);
        }
    }

    #[Route('/api/links', name: 'link.index')]
    public function index(SerializerInterface $serializer): Response
    {
        $links = $this->linkRepository->findAll();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent($serializer->serialize($links, 'json'));

        return $response;
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/api/links/create', name: 'link.store')]
    public function store(Request $request): Response
    {
        $validatedUrl = filter_var($request->get('url'),FILTER_VALIDATE_URL);
        if ($validatedUrl === FALSE)  {
            return new Response('The given url is invalid', 400);
        }

        if ($this->linkRepository->createLink($validatedUrl)) {
            return new Response('The url is saved successfully');
        }

        return new Response('Something is wrong, the url could not be saved', 500);
    }
}
