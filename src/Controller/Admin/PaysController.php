<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted('IS_AUTHENTICATED')]
#[Route('/admin/pays')]
final class PaysController extends AbstractController
{
    #[Route('/new', name: 'app_admin_pays_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pay);
            $entityManager->flush();

            return $this->redirectToRoute('app_pays_index', ['id' => $pay->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/pays/new.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_pays_show', methods: ['GET'])]
    public function show(Pays $pay): Response
    {
        return $this->render('pays/show.html.twig', [
            'pay' => $pay,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_pays_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pays $pay, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/pays/edit.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_pays_delete', methods: ['POST'])]
    public function delete(Request $request, Pays $pay, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
