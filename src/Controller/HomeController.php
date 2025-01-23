<?php

namespace App\Controller;

use App\Form\ProductFilterType;
use App\Repository\ProductRepository;
use App\Repository\ContactRepository;
use App\Repository\SliderRepository;
use App\Repository\CategoryRepository;
use App\Repository\BrandRepository;
use App\Form\ContactType;
use App\Entity\Product;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository, SliderRepository $sliderRepository): Response
    {
        // ** Récupération des sliders et des produits
        $sliders = $sliderRepository->findAll();
        $bestSellerProducts = $productRepository->findBy(['bestSeller' => true]);

        // ** Affichage de la vue
        return $this->render('default/index.html.twig', [
            'sliders' => $sliders,
            'products' => $bestSellerProducts,
        ]);
    }

    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, ContactRepository $contactRepository): Response
    {
        // ** Création du formulaire de contact
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // ** Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $contactRepository->save($contact);
            // ** Ajout d'un message flash
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');
            // ** Redirection vers la même page de contact
            return $this->redirectToRoute('contact');
        }

        return $this->render('default/contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ** Route pour afficher la page d'accueil de l'administration
    #[Route('/admin', name: 'admin_index', methods: ['GET'])]
    public function adminIndex(ProductRepository $productRepository, ContactRepository $contactRepository, SliderRepository $sliderRepository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, AdminRepository $adminRepository): Response
    {
        // ** Récupération des totaux
        $totalProducts = $productRepository->count([]);
        $totalContacts = $contactRepository->count([]);
        $totalSliders = $sliderRepository->count([]);
        $totalCategories = $categoryRepository->count([]);
        $totalBrands = $brandRepository->count([]);
        $totalAdmins = $adminRepository->count([]);

        return $this->render('admin/index.html.twig', [
            'totalProducts' => $totalProducts,
            'totalContacts' => $totalContacts,
            'totalSliders' => $totalSliders,
            'totalCategories' => $totalCategories,
            'totalBrands' => $totalBrands,
            'totalAdmins' => $totalAdmins,
        ]);
    }

    #[Route('/products', name: 'products', methods: ['GET'])]
    public function listProducts(Request $request, ProductRepository $productRepository, BrandRepository $brandRepository): Response
    {
        // ** Création du formulaire de filtre
        $form = $this->createForm(ProductFilterType::class);
        $form->handleRequest($request);

        // ** Récupération des filtres
        $filters = $form->getData() ?? [];
        $currentPage = $request->query->getInt('page', 1);
        $limit = 6;
        $offset = ($currentPage - 1) * $limit;

        // ** Récupération des produits
        $products = $productRepository->findByFilters($filters, $limit, $offset);
        $totalProducts = $productRepository->countByFilters($filters);
        $totalPages = ceil($totalProducts / $limit);
        $brands = $brandRepository->findAll();

        // ** Affichage de la vue
        return $this->render('default/products/products.html.twig', [
            'form' => $form->createView(),
            'products' => $products,
            'brands' => $brands,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    #[Route('/product/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('default/products/show.html.twig', [
            'product' => $product,
        ]);
    }
}