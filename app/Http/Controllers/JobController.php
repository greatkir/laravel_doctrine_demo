<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;

class JobController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $limit
     * @param int $offset
     * @return \Illuminate\Http\Response
     */
    public function index($limit, $offset)
    {
        try {
            $response = [];
            $status_code = 200;
            $job_list = $this->em->getRepository('App\Job')->findBy([], ['created_on' => 'DESC'], $limit, $offset);
            
            foreach ($job_list as $job_single) {
                $response[] = [
                    'id' => $job_single->getId(),
                    'name' => $job_single->getName(),
                    'email' => $job_single->getEmail(),
                    'description' => $job_single->getDescription(),
                    'location' => $job_single->getLocation()->getName(),
                    'brand' => $job_single->getBrand()->getName(),
                    'createdTime' => $job_single->getCreatedTime(),
                ];
            }
        } catch (Exception $e) {
            $status_code = 404;

        } finally {
            return [
                'jobList' => $response,
                'statusCode' => $status_code
            ];
        }
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
                'location' => $job->getLocation()->getName(),
                'brand' => $job->getBrand()->getName(),
                'createdTime' => $job->getCreatedTime(),
            ];
        } catch (Exception $e) {
            $status_code = 404;
        } finally {
            return [
                'job' => $response,
                'statusCode' => $status_code
            ];
        }


    }

}
