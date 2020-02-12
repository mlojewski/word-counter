<?php

namespace App\Controller;

use App\service\DocumentStatCounter;
use App\service\TextTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    /**
     * @Route("/result", name="result")
     */
    public function index(TextTransformer $transformer, DocumentStatCounter $counter)
    {
        $url = $_REQUEST['path'];
        $resultArr = $transformer->textDivider($url);
        
        $wordCount = $counter->globalWordCounter($resultArr);
        $average = $counter->countAverage($resultArr);
        $biggestOccurence = $counter->biggestValueFinder($resultArr);

        return $this->render('result/index.html.twig', [
            'resultArray'       => $resultArr,
            'wordCount'         => $wordCount,
            'average'           => $average,
            'biggestOccurence'  => $biggestOccurence
        ]);
    }
}
