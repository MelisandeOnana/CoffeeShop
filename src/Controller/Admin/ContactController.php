<?php
namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'admin_contact_index', methods: ['GET'])]
    public function index(Request $request, ContactRepository $contactRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;

        $totalContacts = $contactRepository->count([]);
        $totalPages = ceil($totalContacts / $limit);

        $contacts = $contactRepository->findBy([], null, $limit, ($page - 1) * $limit);

        return $this->render('admin/contact/index.html.twig', [
            'contacts' => $contacts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalContacts' => $totalContacts,
        ]);
    }

    #[Route('/new', name: 'admin_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Contact créé avec succès.');

            return $this->redirectToRoute('admin_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_contact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Contact mis à jour avec succès.');

            return $this->redirectToRoute('admin_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_contact_delete', methods: ['POST'])]
    public function delete(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Contact supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}