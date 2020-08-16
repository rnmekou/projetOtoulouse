<?php

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;
use App\Entity\Entreprise;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Doctrine\ORM\EntityManagerInterface;


class EntrepriseService
{

    private $apiKey;
    private $em;

    public function __construct($apiEntrepriseKey, EntityManagerInterface $em)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $apiEntrepriseKey;
        $this->em = $em;
    }


    /**
     * @return array
     */
    public function getEntreprise()
    {

        $messageError = NULL;

        try {

            $response = $this->client->request('GET', 'https://societeinfo.com/app/rest/api/v2/companies.json?key=' . $this->apiKey . '&limit=25');
            $statusCode = $response->getStatusCode();


            if ($statusCode == 404) {
                throw new Exception('Nous ne trouvons aucun résultat, veuillez vérifier l\'orthographe de la ville et reessayez.');
            }

            if ($statusCode !== 200) {
                throw new Exception('Oops ! Il se pourrait que quelque chose n\'ai pas marché. Veuillez reessayer plus tard.');
            }
        } catch (Exception $e) {

            $messageError = $e->getMessage();
            return array(
                'mes' => $messageError
            );
        }


        $json = json_decode($response->getContent(), true);



        for ($i = 0; $i < 25; $i++) {

            if (!$this->em->getRepository('App\Entity\Entreprise')->findOneBy(array('num_Siret' => $json['result'][$i]['full_registration_number']))) {
                $entreprise = new Entreprise();

                $entreprise->setName($json['result'][$i]['name']);
                $entreprise->setActivity($json['result'][$i]['activity']);
                $entreprise->setNumSiret($json['result'][$i]['full_registration_number']);
                $entreprise->setNumSiren($json['result'][$i]['registration_number']);
                $entreprise->setAdress($json['result'][$i]['formatted_address']);

                $this->em->persist($entreprise);
                $this->em->flush();
            }
        }
    }




    /**
     * @return array
     */
    public function getListEntreprise()
    {

        // Get companies in our DB
        $records = $this->em->getRepository('App\Entity\Entreprise')->findAll();

        return $records;
    }


    /**
     * @return array
     */
    public function getEntrepriseByNumSiret(string $numSiret)
    {
        // Get companies names in our DB
        $records = $this->em->getRepository('App\Entity\Entreprise')->findOneBy(array('num_Siret' => $numSiret));

        return $records;
    }
}
