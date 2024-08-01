<?php

namespace App\Controller;

use App\DTO\TimeData;
use App\Form\TimeFormType;
use App\Service\TimeCalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="app_form")
     */
    public function index(): Response
    {
        $timeForm = $this->createForm(TimeFormType::class, null, ['action' => $this->generateUrl('app_form_result')]);

        return $this->render('form/index.html.twig', [
            'timeForm' => $timeForm->createView(),
        ]);
    }

    /**
     * @Route("/form/result", name="app_form_result")
     */
    public function result(Request $request, TimeCalculationService $timeCalculationService): Response
    {
        $timeForm = $this->createForm(TimeFormType::class);
        $timeForm->handleRequest($request);

        if ($timeForm->isSubmitted() && $timeForm->isValid()) {
            /** @var TimeData $timeData */
            $timeData = $timeForm->getData();

            $date = $timeData->getDate();
            $timezone = $timeData->getTimezone();

            return $this->render('form/result.html.twig', [
                'timezone' => $timezone,
                'offsetMinutes' => $timeCalculationService->offsetMinutes($date, $timezone),
                'februaryLength' => $timeCalculationService->februaryLength($date),
                'monthName' => $timeCalculationService->monthName($date),
                'daysInMonth' => $timeCalculationService->daysInMonth($date),
            ]);
        }

        return $this->render('form/index.html.twig', [
            'timeForm' => $timeForm->createView(),
        ]);
    }
}
