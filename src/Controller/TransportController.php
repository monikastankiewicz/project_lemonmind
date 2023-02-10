<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Form\TransportType;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Transport creation form controller
 *
 * @package Project_lemonmind/App/Controller
 * @author Monika Stankiewicz <moniaastankiewicz@gmailcom>
 */
class TransportController extends AbstractController
{
    /**
     * Adding a transport order and redirection to cargo adding form
     * 
     * @param Request $request
     * @param TransportRepository $transportRepository
     * 
     * @return Response
     */
    #[Route('/', name: 'app_transport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TransportRepository $transportRepository): Response
    {
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transportRepository->save($transport, true);
            return $this->redirectToRoute('app_cargo_new', ['transport_id' => $transport->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forms/transport.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }
}
