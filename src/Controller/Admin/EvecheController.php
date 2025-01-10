<?php

namespace App\Controller\Admin;

use App\Entity\Eveche;
use App\Form\EvecheType;
use App\Repository\EvecheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted('IS_AUTHENTICATED')]
#[Route('admin/eveche')]
final class EvecheController extends AbstractController
{
    #[Route('/new', name: 'app_admin_eveche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eveche = new Eveche();
        $form = $this->createForm(EvecheType::class, $eveche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eveche);
            $entityManager->flush();

            return $this->redirectToRoute('app_eveche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/eveche/new.html.twig', [
            'eveche' => $eveche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_eveche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eveche $eveche, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvecheType::class, $eveche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eveche_show', ['id' => $eveche->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/eveche/edit.html.twig', [
            'eveche' => $eveche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_eveche_delete', methods: ['POST'])]
    public function delete(Request $request, Eveche $eveche, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eveche->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($eveche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eveche_index', [], Response::HTTP_SEE_OTHER);
    }
}
