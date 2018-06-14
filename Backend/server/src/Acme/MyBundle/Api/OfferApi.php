<?php


namespace Acme\MyBundle\Api;

use Swagger\Server\Api\OfferApiInterface;
use Swagger\Server\Api\Swagger;
use Swagger\Server\Model\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class OfferApi extends Controller implements OfferApiInterface
{

    protected $container;

    /**
     * @param ContainerInterface|NULL $container
     */
    public function setContainer(
        ContainerInterface $container = NULL
    )
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Sets authentication method api_key
     *
     * @param string $value Value of the api_key authentication method.
     *
     * @return void
     */
    public function setapi_key($value)
    {
        // TODO: Implement setapi_key() method.
    }

    /**
     * Operation addOffer
     *
     * Add a new offer
     *
     * @param  Swagger\Server\Model\Offer $body Offer object that needs to be added (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function addOffer(Offer $body, &$responseCode, array &$responseHeaders)
    {
        $offer = new \Acme\MyBundle\Entity\Offer();
        $offer->setUserid($body->getUserid());
        $offer->setTitle($body->getTitle());
        $offer->setDescription($body->getDescription());
        $offer->setOffercondition($body->getCondition());
        $offer->setStart(new \DateTime($body->getStart()));
        $offer->setEnd(new \DateTime($body->getEnd()));

        $em = $this->getDoctrine()->getManager();

        $em->persist($offer);
        $em->flush();
        return;

    }

    /**
     * Operation deleteOffer
     *
     * Deletes a offer
     *
     * @param  int $offerId Offer id to delete (required)
     * @param  string $apiKey (optional)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function deleteOffer($offerId, $apiKey = null, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $entityManager = $this->getDoctrine()->getManager();
        $offer = $entityManager->getRepository(\Acme\MyBundle\Entity\Offer::class)->find($offerId);


        $em->remove($offer);
        $em->flush();
        return;
    }

    /**
     * Operation findOffersByUser
     *
     * Finds Offer by user
     *
     * @param  int $userid Status values that need to be considered for filter (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\Offer[]
     *
     */
    public function findOffersByUser($userid, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $eoffers = $em->getRepository('MyBundle:Offer')->findBy(
            array('userid' => $userid)
        );

        if($eoffers) {
            $offers = array();
            foreach($eoffers as $eoffer){
                $offer = new Offer();
                $offer->setId($eoffer->getId());
                $offer->setUserid($eoffer->getUserid());
                $offer->setTitle($eoffer->getTitle());
                $offer->setDescription($eoffer->getDescription());
                $offer->setCondition($eoffer->getOffercondition());
                $offer->setStart($eoffer->getStart()->format('d.m.Y H:i:s'));
                $offer->setEnd($eoffer->getEnd()->format('d.m.Y H:i:s'));

                $offers[] = $offer;
            }
            return $offers;
        }
        return false;
    }

    /**
     * Operation getOfferById
     *
     * Find offer by ID
     *
     * @param  int $offerId ID of the offer to return (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\Offer[]
     *
     */
    public function getOfferById($offerId, &$responseCode, array &$responseHeaders)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $eoffer = $entityManager->getRepository(\Acme\MyBundle\Entity\Offer::class)->find($offerId);
        if($eoffer) {

            $offer = new Offer();
            $offer->setId($eoffer->getId());
            $offer->setUserid($eoffer->getUserid());
            $offer->setTitle($eoffer->getTitle());
            $offer->setDescription($eoffer->getDescription());
            $offer->setCondition($eoffer->getOffercondition());
            $offer->setStart($eoffer->getStart()->format('d.m.Y H:i:s'));
            $offer->setEnd($eoffer->getEnd()->format('d.m.Y H:i:s'));



            return $offer;
        }
        return;
    }

    /**
     * Operation findOffersByCoordinates
     *
     * Finds Offer by Coordinates
     *
     * @param  int $coordinates Coodinates of the current position (required)
     * @param  int $distance Maximum distance to an offer (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\Offer[]
     *
     */
    public function findOffersByCoordinates($coordinates, $distance, &$responseCode, array &$responseHeaders)
    {
        if(strpos($coordinates, ',') !== false) {
            $coord_pos = explode(",", $coordinates);
        } else {
            return false;
        }

        if(count($coord_pos) != 2){
            return false;
        }


        // User finden
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('MyBundle:User')->findAll();

        $tusers = array();

        foreach ($users as $user){
            $coord_tar = explode(",", $user->getCoordinates());
            if($this->distance($coord_pos[0],$coord_pos[1],$coord_tar[0],$coord_tar[1],"K") < ($distance/1000)){
                array_push($tusers, $user);
            }
        }

        // Offer laden
        $eoffers = array();
        foreach ($tusers as $tuser) {
            if(sizeof($eoffers) == 0){
                $eoffers = $entityManager->getRepository('MyBundle:Offer')->findBy(
                    array('userid' => $tuser->getId())
                );
            }else {
                array_merge($eoffers, $entityManager->getRepository('MyBundle:Offer')->findBy(
                    array('userid' => $tuser->getId())
                ));
            }
        }
        if($eoffers) {
            $offers = array();
            foreach($eoffers as $eoffer){

                $offer = new Offer();
                $offer->setId($eoffer->getId());
                $offer->setUserid($eoffer->getUserid());
                $offer->setTitle($eoffer->getTitle());
                $offer->setDescription($eoffer->getDescription());
                $offer->setCondition($eoffer->getOffercondition());
                $offer->setStart($eoffer->getStart()->format('d.m.Y H:i:s'));
                $offer->setEnd($eoffer->getEnd()->format('d.m.Y H:i:s'));

                $offers[] = $offer;
            }
            return $offers;
        }
        return false;

        // Offer überprüfen start < jetzt < stop



        // Offer zurückgeben

        return false;

    }


    private function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
