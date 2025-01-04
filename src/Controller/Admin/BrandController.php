<?php
namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/brand')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'admin_brand_index', methods: ['GET'])]
    public function index(Request $request, BrandRepository $brandRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;

        $totalBrands = $brandRepository->count([]);
        $totalPages = ceil($totalBrands / $limit);

        $brands = $brandRepository->findBy([], null, $limit, ($page - 1) * $limit);

        return $this->render('admin/brand/index.html.twig', [
            'brands' => $brands,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalBrands' => $totalBrands,
        ]);
    }

    #[Route('/new', name: 'admin_brand_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($brand);
            $entityManager->flush();

            $this->addFlash('success', 'Marque créée avec succès.');

            return $this->redirectToRoute('admin_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_brand_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Brand $brand, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Marque mise à jour avec succès.');

            return $this->redirectToRoute('admin_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_brand_delete', methods: ['POST'])]
    public function delete(Request $request, Brand $brand, EntityManagerInterface $entityManager): Response
    {
        // Vérifie si la marque est associée à des produits
        $productCount = count($brand->getProducts());
        if ($productCount > 0) {
            $this->addFlash('error', 'Impossible de supprimer la marque car elle est associée à des produits.');
            return $this->redirectToRoute('admin_brand_index');
        }

        // Supprime la marque
        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $entityManager->remove($brand);
            $entityManager->flush();

            $this->addFlash('success', 'Marque supprimée avec succès.');
        }

        return $this->redirectToRoute('admin_brand_index', [], Response::HTTP_SEE_OTHER);
    }
}