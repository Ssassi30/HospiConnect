<?php

namespace App\Controller;

use App\Entity\MouvementsStock;
use App\Form\MouvementStockType;
use App\Repository\MouvementsStockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mouvement_stock')]
final class MouvementStockController extends AbstractController
{
    #[Route('/', name: 'app_mouvement_stock_index', methods: ['GET'])]
    public function index(MouvementsStockRepository $mouvementsStockRepository): Response
    {
        return $this->render('mouvement_stock/index.html.twig', [
            'mouvements_stocks' => $mouvementsStockRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mouvement_stock_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $mouvementStock = new MouvementsStock();
        $form = $this->createForm(MouvementStockType::class, $mouvementStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($mouvementStock);
            $em->flush();
            $this->addFlash('success', 'Mouvement de stock ajouté avec succès !');
            return $this->redirectToRoute('app_mouvement_stock_index');
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'ajout du mouvement de stock.');
        }

        return $this->render('mouvement_stock/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_mouvement_stock_show', methods: ['GET'])]
    public function show(MouvementsStock $mouvementStock): Response
    {
        return $this->render('mouvement_stock/show.html.twig', [
            'mouvement_stock' => $mouvementStock,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_mouvement_stock_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MouvementsStock $mouvementStock, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MouvementStockType::class, $mouvementStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Mouvement de stock mis à jour avec succès.');
            return $this->redirectToRoute('app_mouvement_stock_index');
        }

        return $this->render('mouvement_stock/edit.html.twig', [
            'form' => $form->createView(),
            'mouvement_stock' => $mouvementStock,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_mouvement_stock_delete')]
    public function delete(Request $request, MouvementsStock $mouvementStock, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mouvementStock->getId(), $request->request->get('_token'))) {
            $em->remove($mouvementStock);
            $em->flush();
            $this->addFlash('success', 'Mouvement de stock supprimé avec succès.');
        }

        return $this->redirectToRoute('app_mouvement_stock_index');
    }
}