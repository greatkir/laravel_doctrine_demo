<?php

namespace App\Http\Controllers;

use Doctrine\ORM\EntityManagerInterface;

class LocationController extends Controller
{
    const SUCCESS_CODE = 200;
    const ERROR_CODE   = 404;

    /**
     * Create new controller and entity manager by depedency injection
     *
     * @param Doctrine\ORM\EntityManagerInterface $em
     * @return void
     */
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
            $response    = [];
            $status_code = self::SUCCESS_CODE;
            $locations   = $this->em->getRepository('App\Location')->findAll();
            foreach ($locations as $location_single) {
                $response[] = [
                    'id'          => $location_single->getId(),
                    'name'        => $location_single->getName(),
                    'createdTime' => $location_single->getCreatedTime(),
                ];
            }
        } catch (Exception $e) {
            $status_code = self::ERROR_CODE;
        } finally {
            return [
                'locationList' => $response,
                'statusCode'   => $status_code
            ];
        }
    }
}
