<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Entreprise;
use App\Service\EntrepriseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SearchBarType;
use Doctrine\Common\Collections\Expr\Value;

class EntreprisesController extends AbstractController
{
    private $entrepriseService;

    public function __construct(entrepriseService $entreprise)
    {
        $this->entrepriseService = $entreprise;
    }

    /**
     * @Route("/", name="entreprises")
     */
    public function index(Request $request)
    {

        $numSiret = "";
        $result1 =  null;

        $value = 0;

        $searchForm = $this->createForm(SearchBarType::class);

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {

            $data = $searchForm->getData();

            $numSiret = $data['num_siret'];
            $result1 = $this->entrepriseService->getEntrepriseByNumSiret($numSiret);

            if ($result1) {
                $value = 2;
            } else {
                $value = 3;
            }
        }




        //Getting companies from the API and saving them in the dataBase if there are not already in
        //$result = $this->entrepriseService->getEntreprise();


        //Call for the companies saved in DB
        $results = $this->entrepriseService->getListEntreprise();


        //dump($result1);


        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController',
            'list' => $results,
            'searchBarForm' => $searchForm->createView(),
            'entreprise' => $result1,
            'value' => $value
        ]);
    }
}
