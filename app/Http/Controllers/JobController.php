<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class JobController extends Controller
{
    protected $em;

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
        return array(
            1 => "John",
            2 => "Mary",
            3 => "Steven"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $response = [];
            $status_code = 200;
            $job = $this->em->find(Job::class, $id);
            $response = [
                'id' => $job->getId(),
                'name' => $job->getName(),
                'email' => $job->getEmail(),
                'description' => $job->getDescription(),
                'location' => $job->getLocation(),
                'brand' => $job->getBrand(),
                'created_time' => $job->getCreatedTime(),
            ];
        } catch (Exception $e) {
            $status_code = 404;
        } finally {
            return response()->json ([
                'job' => $response,
                'statusCode' => $status_code
            ]);
        }


    }

}
