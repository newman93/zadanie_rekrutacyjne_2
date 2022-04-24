<?php

namespace App\Controller;

use App\Entity\Zamowienie;
use App\Form\ZamowienieType;
use App\Form\Zamowienie2Type;
use App\Repository\ZamowienieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @Route("/zamowienie")
 */
class ZamowienieController extends AbstractController
{
    /**
     * @Route("/", name="app_zamowienie_index", methods={"GET"})
     */
    public function index(ZamowienieRepository $zamowienieRepository): Response
    {
        $zamowienie = new Zamowienie();
        $form = $this->createForm(Zamowienie2Type::class, $zamowienie);

        return $this->render('zamowienie/index.html.twig', [
            'zamowienies' => $zamowienieRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

       
    /**
     * @Route("/search", name="app_zamowienie_search")
     */
    public function search(ZamowienieRepository $zamowienieRepository, Request $request): Response
    {
            $zam = $zamowienieRepository->findByNumerAndStatus($request->get('numer'), $request->get('status')); 
            
            return new Response(json_encode($zam != null? $zam->getId() : 0));
    }   

    /**
     * @Route("/new", name="app_zamowienie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ZamowienieRepository $zamowienieRepository): Response
    {
        $zamowienie = new Zamowienie();
        $form = $this->createForm(ZamowienieType::class, $zamowienie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $zamowienieRepository->add($zamowienie);
            return $this->redirectToRoute('app_zamowienie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('zamowienie/new.html.twig', [
            'zamowienie' => $zamowienie,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}", name="app_zamowienie_show", methods={"GET"})
     */
    public function show(Zamowienie $zamowienie): Response
    {
        return $this->render('zamowienie/show.html.twig', [
            'zamowienie' => $zamowienie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_zamowienie_edit", methods={"GET", "POST"})
     */
    public function edit(ManagerRegistry $doctrine, Request $request, Zamowienie $zamowienie, ZamowienieRepository $zamowienieRepository, HttpClientInterface $client): Response
    {
        $zam = $zamowienieRepository->findOneById($zamowienie->getId());
        $entityManager = $doctrine->getManager();
        $zam = $entityManager->getUnitOfWork()->getOriginalEntityData($zamowienie);
        $form = $this->createForm(ZamowienieType::class, $zamowienie);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($zam['status_id'] != $zamowienie->getStatus()->getId() 
              &&   ($zamowienie->getSubNadawca() || $zamowienie->getSubOdbiorca() || $zamowienie->getSubZleceniodawca())) {
                /*$response = $this->client->request(
                    'GET',
                    'powiadomienie klientow'
                );*/
                $this->addFlash('success', 'Powiadomiono klienta!');
            } else {
                $this->addFlash('success',  'Bez powiadomiwnia!');

            }
        
            $zamowienieRepository->add($zamowienie);

            return $this->redirectToRoute('app_zamowienie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('zamowienie/edit.html.twig', [
            'zamowienie' => $zamowienie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_zamowienie_delete", methods={"POST"})
     */
    public function delete(Request $request, Zamowienie $zamowienie, ZamowienieRepository $zamowienieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zamowienie->getId(), $request->request->get('_token'))) {
            $zamowienieRepository->remove($zamowienie);
        }

        return $this->redirectToRoute('app_zamowienie_index', [], Response::HTTP_SEE_OTHER);
    }

 
}
