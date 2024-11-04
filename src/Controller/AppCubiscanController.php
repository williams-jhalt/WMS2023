<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppCubiscanController extends AbstractController
{

    #[Route('/cubiscan', name: 'cubiscan_post', methods: ['POST'])]
    public function postAction(Request $request)
    {
        if ($request->isMethod("POST")) {
            $data = json_decode($request->getContent(), true);

            if ($data['Command'] == "Carton Data Post") {

                $username = $request->headers->get('php-auth-user');
                $password = $request->headers->get('php-auth-pw');

                $url = "https://releasesupport.deposco.com/integration/WTC/containers/" . $data['CartonID'];

                $auth = base64_encode("{$username}:{$password}");

                $options = [
                    'http' => [
                        'header' => "Authorization: Basic " . $auth . "\n" .
                            "Content-Type: application/json\n",
                        "protocol_version" => "1.1",
                        'method' => 'PUT',
                        'content' => json_encode([
                            'container' => [
                                'businessUnit' => "WTC",
                                'lpn' => $data['CartonID'],
                                'number' => $data['CartonID'],
                                'description' => "Updated from WMS-SERVER (CUBISCAN)",
                                'dimension' => [
                                    'length' => $data['Length'],
                                    'width' => $data['Width'],
                                    'height' => $data['Height'],
                                    'units' => $data['DimUOM']
                                ],
                                'weight' => [
                                    'weight' => $data['Weight'],
                                    'units' => $data['WeightUOM']
                                ]
                            ]
                        ])
                    ]
                ];

                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                return new JsonResponse($result);
            }

            /*Carton Data Post packet example 
            {
            "Command":"Carton Data Post",
            "CartonID":"CL41238221",
            "Barcode2":"",
            "Barcode3":"",
            "Barcode4":"",
            "Barcode5":"",
            "Sequence":1234,
            "Length":"23.00",
            "Width":"9.00",
            "Height":"6.00",
            "Weight":"3.00",
            "DimUOM":"in",
            "WeightUOM":"lb",
            "ScanStatus":"0",
            "DimStatus":"0",
            "WeightStatus":"0",
            "SiteID":"OAK"
            }
            Carton Data Response packet example for successful post
            {
            "Command":"Carton Data Response",
            "CartonID":"CL41238221",
            "Sequence":1234,
            "StatusCode":0,
            "Message":"Carton Data Received",
            }
            Carton Data Response packet example for failed post
            {
            "Command":"Carton Data Response",
            "CartonID":"CL41238221",
            "Sequence":1234,
            "StatusCode":1,
            "Message":"Error: CartonID not found",*/
        }
    }
}