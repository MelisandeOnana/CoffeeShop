<?php
namespace App\Controller\Admin;

use App\Entity\Slider;
use App\Form\SliderType;
use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/slider')]
class SliderController extends AbstractController
{
    #[Route('/', name: 'admin_slider_index', methods: ['GET'])]
    public function index(Request $request, SliderRepository $sliderRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;

        $totalSliders = $sliderRepository->count([]);
        $totalPages = ceil($totalSliders / $limit);

        $sliders = $sliderRepository->findBy([], null, $limit, ($page - 1) * $limit);

        return $this->render('admin/slider/index.html.twig', [
            'sliders' => $sliders,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    #[Route('/new', name: 'admin_slider_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $slider = new Slider();
        $form = $this->createForm(SliderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($slider);
            $entityManager->flush();

            $this->addFlash('success', 'Slider créé avec succès.');

            return $this->redirectToRoute('admin_slider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/slider/new.html.twig', [
            'slider' => $slider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_slider_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Slider $slider, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SliderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $entityManager->flush();

            $this->addFlash('success', 'Slider mis à jour avec succès.');

            return $this->redirectToRoute('admin_slider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/slider/edit.html.twig', [
            'slider' => $slider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_slider_delete', methods: ['POST'])]
    public function delete(Request $request, Slider $slider, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slider->getId(), $request->request->get('_token'))) {
            $entityManager->remove($slider);
            $entityManager->flush();

            $this->addFlash('success', 'Slider supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_slider_index', [], Response::HTTP_SEE_OTHER);
    }
}