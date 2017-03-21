<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class LocationController extends Controller
{
    const SUCCESSCODE = 200;
    const ERRORCODE = 404;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = [];
            $status_code = self::SUCCESSCODE;
            $locations = $this->em->getRepository('App\Location')->findAll();
            foreach ($locations as $location_single) {
                $response[] = [
                    'id' => $location_single->getId(),
                    'name' => $location_single->getName(),
                    'createdTime' => $location_single->getCreatedTime(),
                ];
            }
        } catch (Exception $e) {
            $status_code = self::ERRORCODE;
        } finally {
            return [
                'locationList' => $response,
                'statusCode' => $status_code
            ];
        }
    }

}
