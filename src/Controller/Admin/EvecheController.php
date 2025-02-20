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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


#[IsGranted('IS_AUTHENTICATED')]
#[Route('admin/province')]
final class EvecheController extends AbstractController
{
    #[Route('/new', name: 'app_admin_eveche_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_admin_eveche_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(?Eveche $eveche, Request $request, EntityManagerInterface $entityManager): Response
    {
        $eveche ??= new Eveche();
        $form = $this->createForm(EvecheType::class, $eveche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageUrl = $form->get('imageUrl')->getData();
            if ($imageUrl){
                $newImageName = uniqid().'.'.$imageUrl->guessExtension();

                try{
                    $imageUrl->move(
                        $this->getParameter('upload_directory'),
                        $newImageName
                    );
                    $eveche->setImageUrl($newImageName);
                } catch (FileException $e){
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image.');
                }
            }

            $entityManager->persist($eveche);
            $entityManager->flush();

            return $this->redirectToRoute('app_eveche_show', ['id' => $eveche->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/eveche/new.html.twig', [
            'eveche' => $eveche,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_SUPERADMIN')]
    #[Route('/delete/{id}', name: 'app_admin_eveche_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Eveche $eveche, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eveche->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($eveche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eveche_index', [], Response::HTTP_SEE_OTHER);
    }
}
