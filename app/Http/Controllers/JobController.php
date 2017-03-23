<?php

namespace App\Http\Controllers;

use App\Job;
use App\Location;
use App\Brand;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class JobController extends Controller
{

    const DEFAULT_LIMIT = 5;
    const DEFAULT_SORT  = 'DESC';
    const SUCCESS_CODE  = 200;
    const ERROR_CODE    = 404;

    private $em;

    /**
     * Create a new controller and entity manager property by depedency injection
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
     * @param Illuminate\Http\Request $request
     * @param int|null $offset
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $offset = null)
    {
        try {
            $response    = [];
            $status_code = self::SUCCESS_CODE;
            $limit       = self::DEFAULT_LIMIT;
            $links       = [];
            $criteria    = $this->buildCriteria($request);
            $job_list    = $this->em->getRepository('App\Job')->findBy($criteria,
                                                                       ['created_on' => self::DEFAULT_SORT],
                                                                       $limit,
                                                                       $offset);
            foreach ($job_list as $job_single) {
                $response[] = [
                    'id'          => $job_single->getId(),
                    'name'        => $job_single->getName(),
                    'email'       => $job_single->getEmail(),
                    'description' => $job_single->getDescription(),
                    'location'    => $job_single->getLocation()->getName(),
                    'brand'       => $job_single->getBrand()->getName(),
                    'createdTime' => $job_single->getCreatedTime(),
                ];
            }
            $links = $this->buildLinks($criteria, $limit, $offset);
        } catch (Exception $e) {
            $status_code = self::ERROR_CODE;
        } finally {
            return [
                'jobList'    => $response,
                'links'      => $links,
                'start'      => $offset + 1,
                'limit'      => $limit,
                'statusCode' => $status_code,
            ];
        }
    }

    /**
     * 
     * @param array $criteria
     * @param int $limit
     * @param int|null $offset
     * @return array
     */
    private function buildLinks($criteria, $limit, $offset)
    {
        $links = [];
        $api_url = 'api/job/offset/';
        $prev  = $offset - $limit;
        //yes, second never will be false, but it is important control point
        if (($offset > 0) && ($prev >= 0)) {
            $links['prev'] = $api_url . $prev . '?';
            foreach ($criteria as $key => $value) {
                $links['prev'] .= $key . '=' . $value . "&";
            }
        }

        //think most easy way to do it through ORM
        $job_list = $this->em->getRepository('App\Job')->findBy($criteria,
                                                                ['created_on' => self::DEFAULT_SORT],
                                                                $limit,
                                                                $offset + $limit);
        if (!empty($job_list)) {
            $links['next'] = $api_url . ($limit + $offset) . '?';
            foreach ($criteria as $key => $value) {
                $links['next'] .= $key . '=' . $value . "&";
            }
        }
        return $links;
    }

    /**
     * 
     * @param Illuminate\Http\Request $request
     * @return array
     */
    private function buildCriteria($request)
    {
        $criteria = [];
        if ($request->has('name')) {
            $criteria['name'] = $request->name;
        }
        if ($request->has('brand')) {
            $criteria['brand'] = $this->em->find(Brand::class, $request->brand)->getID();
        }
        if ($request->has('location')) {
            $criteria['location'] = $this->em->find(Location::class,
                                                    $request->location)->getID();
        }

        return $criteria;
    }

    /**
     * Fast count of total records.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        try {
            $status_code     = self::SUCCESS_CODE;
            $job_total_count = $this->em->getRepository('App\Job')->createQueryBuilder('u')
                    ->select('count(u.id)')
                    ->getQuery()
                    ->getSingleScalarResult();
        } catch (Exception $e) {
            $status_code = self::ERROR_CODE;
        } finally {
            return [
                'jobCount'   => (int) $job_total_count,
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
            $response    = [];
            $status_code = self::SUCCESS_CODE;
            $job         = $this->em->find(Job::class, $id);
            $response    = [
                'id'          => $job->getId(),
                'name'        => $job->getName(),
                'email'       => $job->getEmail(),
                'description' => $job->getDescription(),
                'location'    => $job->getLocation()->getName(),
                'brand'       => $job->getBrand()->getName(),
                'createdTime' => $job->getCreatedTime(),
            ];
        } catch (Exception $e) {
            $status_code = self::ERROR_CODE;
        } finally {
            return [
                'job'        => $response,
                'statusCode' => $status_code
            ];
        }
    }

}
