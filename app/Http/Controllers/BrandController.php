<?php

namespace App\Http\Controllers;

use Doctrine\ORM\EntityManagerInterface;

class BrandController extends Controller
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
            $brands      = $this->em->getRepository('App\Brand')->findAll();
            foreach ($brands as $brand_single) {
                $response[] = [
                    'id'          => $brand_single->getId(),
                    'name'        => $brand_single->getName(),
                    'createdTime' => $brand_single->getCreatedTime(),
                ];
            }
        } catch (Exception $e) {
            $status_code = self::ERROR_CODE;
        } finally {
            return [
                'brandList'  => $response,
                'statusCode' => $status_code
            ];
        }
    }
}
