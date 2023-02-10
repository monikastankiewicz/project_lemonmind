<?php

namespace App\Controller;

use App\Entity\Cargo;
use App\Form\CargoType;
use App\Repository\CargoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Cargo creation form controller
 *
 * @package Project_lemonmind/App/Controller
 * @author Monika Stankiewicz <moniaastankiewicz@gmailcom>
 */
class CargoController extends AbstractController
{
    /**
     * Adding a cargo
     * 
     * @param Request $request
     * @param CargoRepository $cargoRepository
     * 
     * @return Response
     */
    #[Route('/transport/{transport_id}/add-cargo', name: 'app_cargo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CargoRepository $cargoRepository): Response
    {
        $cargo = new Cargo();
        $form = $this->createForm(CargoType::class, $cargo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $cargoRepository->save($cargo, true);

            // return $this->redirectToRoute('app_cargo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forms/cargo.html.twig', [
            'cargo' => $cargo,
            'form' => $form,
        ]);
    }
}
