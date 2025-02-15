<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class MaterielController extends AbstractController
{
    #[Route('/materiel', name: 'app_materiel')]
    public function index(): Response
    {
        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }

    #[Route('/materiel/add', name: 'app_materiel_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $materiel = new Materiel();
        
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($materiel);
            $em->flush();
            $this->addFlash('success', 'Matériel ajouté avec succès !');
            return $this->redirectToRoute('app_materiel_list');
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'ajout du matériel.');
        }

        return $this->render('materiel/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/materiel/list', name: 'app_materiel_list')]
    public function materielList(MaterielRepository $materielRepository): Response
    {
        $materiels = $materielRepository->findAll();
        return $this->render('materiel/list.html.twig', [
            'materiels' => $materiels
        ]);
    }

    #[Route('/materiel/{id}', name: 'app_materiel_show')]
    public function show(Materiel $materiel): Response
    {
        // Récupérer les mouvements de stock associés au matériel
        $mouvementsStocks = $materiel->getMouvementsStocks();
    
        return $this->render('mouvement_stock/show.html.twig', [
            'materiel' => $materiel, // Passer le matériel au template
            'mouvementsStocks' => $mouvementsStocks, // Passer les mouvements de stock associés
        ]);
    }

    #[Route('/materiel/edit/{id}', name: 'app_materiel_edit')]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Matériel mis à jour avec succès.');
            return $this->redirectToRoute('app_materiel_list');
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'ajout du matériel.');
        }

        return $this->render('materiel/edit.html.twig', [
            'form' => $form->createView(),
            'materiel' => $materiel,
        ]);
    }

    #[Route('/materiel/delete/{id}', name: 'app_materiel_delete')]
    public function delete(Request $request, Materiel $materiel, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $materiel->getId(), $request->request->get('_token'))) {
            $em->remove($materiel);
            $em->flush();
            $this->addFlash('success', 'Matériel supprimé avec succès.');
        }

        return $this->redirectToRoute('app_materiel_list');
    }
}