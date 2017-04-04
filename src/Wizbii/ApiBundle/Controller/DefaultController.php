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

        /*$v   = $request->query->get("v");
        $t   = $request->query->get("t");
        $dl  = $request->query->get("dl");
        $dr  = $request->query->get("dr");
        $wct = $request->query->get("wct");
        if(is_null($wct)){
            //read from cookie
        }

        $wui = $request->query->get("wui");
        if(is_null($wui)){
            //read from cookie
        }

        $wuui = $request->query->get("wuui");
        if(is_null($wuui)){
            //read from cookie
        }

        $ec = $request->query->get("ec");
        $ea = $request->query->get("ea");
        $el = $request->query->get("el");
        $ev = $request->query->get("ev");
        $tid = $request->query->get("tid");
        $ds = $request->query->get("ds");
        $cn = $request->query->get("cn");
        $cs = $request->query->get("cs");
        $cm = $request->query->get("cm");
        $ck = $request->query->get("ck");
        $cc = $request->query->get("cc");
        $sn = $request->query->get("sn");
        $an = $request->query->get("an");
        $av = $request->query->get("av");
        $qt = $request->query->get("qt");*/

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
        /*$entry = new ApiEntry();
        $entry->setV($v);
        $entry->setT($t);
        $entry->setDl($dl);
        $entry->setDr($dr);
        $entry->setWct($wct);
        $entry->setWui($wui);
        $entry->setWuui($wuui);
        $entry->setEc($ec);
        $entry->setEa($ea);
        $entry->setEl($el);
        $entry->setEv($ev);
        $entry->setTid($tid);
        $entry->setDs($ds);
        $entry->setCn($cn);
        $entry->setCs($cs);
        $entry->setCm($cm);
        $entry->setCk($ck);
        $entry->setCc($cc);
        $entry->setSn($sn);
        $entry->setAn($an);
        $entry->setAv($av);
        $entry->setQt($qt);*/


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
