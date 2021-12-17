<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormulaireType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormulaireType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();
        }

        $name = $request->query->get('name');
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'zobmalin',
            'name' => $name,
            'contacts' => $this->contactRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/contact/{id}", name="contactId")
     */
    public function contactId(Request $request, int $id): Response
    {
        $name = $request->query->get('name');



        return $this->render('contact/index.html.twig', [
            'controller_name' => 'zobmalin',
            'name' => $name,
            'contact' => $this->contactRepository->find($id)
        ]);
    }

    /**
     * @Route("/contact/{city}", name="contactCity")
     */
    public function contactCity(string $city): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'zobmalin',
            'city' => $city
        ]);
    }
}
