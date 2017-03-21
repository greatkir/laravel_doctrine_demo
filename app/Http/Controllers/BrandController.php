<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class BrandController extends Controller
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
            $brands = $this->em->getRepository('App\Brand')->findAll();
            foreach ($brands as $brand_single) {
                $response[] = [
                    'id' => $brand_single->getId(),
                    'name' => $brand_single->getName(),
                    'createdTime' => $brand_single->getCreatedTime(),
                ];
            }
        } catch (Exception $e) {
            $status_code = self::ERRORCODE;
        } finally {
            return [
                'brandList' => $response,
                'statusCode' => $status_code
            ];
        }
    }
}
