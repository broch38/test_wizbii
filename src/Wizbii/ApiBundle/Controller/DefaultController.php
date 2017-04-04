<?php

namespace Wizbii\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Wizbii\ApiBundle\Document\ApiEntry;

class DefaultController extends Controller
{
    /**
     * @Route("/collect")
     */
    public function indexAction(Request $request)
    {
        $expectedVars = array("v","t","dl","dr","wct","wui","wuui","ec","ea","el","ev","tid","ds","cn","cs","cm","ck","cc","sn","an","av","qt");
        $entry = new ApiEntry();

        foreach($expectedVars as $var){
            $entry->{"set".ucfirst($var)}($request->query->get($var));
        }

        if(is_null($entry->getWct())){
            $entry->setWct($request->cookies->get("wct"));
        }

        if(is_null($entry->getWui())){
            $entry->setWui($request->cookies->get("wui"));
        }

        if(is_null($entry->getWuui())){
            $entry->setWuui($request->cookies->get("uniqUserId"));
        }

        

        $dm = $this->get('doctrine_mongodb')->getManager();
        $repository = $dm->getRepository('WizbiiApiBundle:ApiEntry');
        $old_entry = $repository->findOneBy(array(
            't' => $entry->getT(),
            "wct"=>$entry->getWct(),
            "wui"=>$entry->getWui(),
            "wuui"=>$entry->getWuui(),
            "tid"=>$entry->getTid(),
            "addtime"=>time()
            ));

        if(!is_null($old_entry))
        {
            return new Response("");
        }



        $validator = $this->get('validator');
        $errors = $validator->validate($entry);

        if (count($errors) > 0) {
            $return_err = array();
            foreach($errors as $error){
                $return_err[] = array(
                    "message" => $error->getMessage(),
                    "propertyPath" => $error->getPropertyPath(),
                    "invalidValue" => $error->getInvalidValue(),
//                    "code" => $error->getCode()
                );
            }

            return new JsonResponse(array("errors"=>$return_err));
        }

        $dm->persist($entry);
        $dm->flush();

        return new JsonResponse(array("success"=>$entry->getId()));

    }
}
