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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[IsGranted('IS_AUTHENTICATED')]
#[Route('/admin/pays')]
final class PaysController extends AbstractController
{
    #[Route('/new', name: 'app_admin_pays_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_admin_pays_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(?Pays $pay, Request $request, EntityManagerInterface $entityManager): Response
    {
        $pay ??= new Pays();
        $form = $this->createForm(PaysType::class, $pay);
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
                    $pay->setImageUrl($newImageName);
                } catch (FileException $e){
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image.');
                }
            }
            $entityManager->persist($pay);
            $entityManager->flush();

            return $this->redirectToRoute('app_pays_show', ['id' => $pay->getId()], Response::HTTP_SEE_OTHER);
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

    #[IsGranted('ROLE_SUPERADMIN')]
    #[Route('/delete/{id}', name: 'app_admin_pays_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Pays $pay, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
