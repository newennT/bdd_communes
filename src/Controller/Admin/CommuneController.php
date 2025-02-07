<?php

namespace App\Controller\Admin;

use App\Entity\Commune;
use App\Form\CommuneType;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED')]
#[Route('/admin/commune')]
final class CommuneController extends AbstractController
{
    #[Route('/new', name: 'app_admin_commune_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_admin_commune_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]

    public function new(?Commune $commune, Request $request, EntityManagerInterface $entityManager): Response
    {
        $commune ??= new Commune();
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commune);
            $entityManager->flush();

            return $this->redirectToRoute('app_commune_show', ['id' => $commune->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/commune/new.html.twig', [
            'commune' => $commune,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_SUPERADMIN')]
    #[Route('/delete/{id}', name: 'app_admin_commune_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Commune $commune, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commune->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($commune);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commune_index', [], Response::HTTP_SEE_OTHER);
    }
}
