<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Entreprise;
use App\Service\EntrepriseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntreprisesController extends AbstractController
{
        private $entrepriseService;

    public function __construct(entrepriseService $entreprise)
    {
        $this->entrepriseService = $entreprise;
    }
    ### /**
    ### * @Route("/entreprises", name="entreprises")
    ###*/
    public function index()
    {
        /*$entreprise->setNumSiret('99999');
        $entreprise->setName('nadia');
        $entreprise->setNumSiren('99999');
        $entreprise->setAdress('iuiytrtetyrui');
        $entreprise->setActivity('21/O6/2020');
        */
       

        //Getting companies from the API and saving them in the dataBase if there are not already in
       // $result = $this->entrepriseService->getEntreprise();


        //Call for the companies saved in DB
        $results = $this->entrepriseService->getListEntreprise();

       
/*      dump($entreprise);
        dump("result1"); 
        dump($result);*/
        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController',
            'list' => $results
        ]);
        
    }
}
