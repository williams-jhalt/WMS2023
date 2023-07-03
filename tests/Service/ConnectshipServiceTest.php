<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use DateTime;

class ConnectshipServiceTest extends TestCase
{
    public function testGetTrackingNumberByUcc(): void
    {

        $mockSoap = $this->getMockFromWsdl(
            __DIR__ . '/connectship_wsdl.xml',
            'AMPServices'
        );

        $connectshipServiceTestService = new ConnectshipServiceTestService($mockSoap);

        $searchResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [ (object) [
                        'resultData' => (object) [
                            'trackingNumber' => "TEST"
                        ]
                    ] ]
                ]
            ]
        ];

        $listCarriersResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [
                        (object) ['symbol' => 'CAR1', 'name'=> 'CARRIER1'],
                        (object) ['symbol' => 'CAR2', 'name'=> 'CARRIER2']
                    ]
                ]
            ]
        ];

        $mockSoap->expects($this->any())
            ->method('ListCarriers')
            ->willReturn($listCarriersResult);

        $mockSoap->expects($this->any())
            ->method('Search')
            ->willReturn($searchResult);

        $trackingNumber = $connectshipServiceTestService->getTrackingNumberByUcc("test");

        $this->assertSame('TEST', $trackingNumber);
    }
    public function testGetShippingDataByUcc(): void
    {
     
        $mockSoap = $this->getMockFromWsdl(
            __DIR__ . '/connectship_wsdl.xml',
            'AMPServices'
        );

        $connectshipServiceTestService = new ConnectshipServiceTestService($mockSoap);

        $searchResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [ 
                        (object) [
                            'resultData' => (object) [
                                'trackingNumber' => "TEST"
                            ]
                        ], 
                        (object) [
                            'resultData' => (object) [
                                'trackingNumber' => "TEST2"
                        ]] 
                    ]
                ]
            ]
        ];

        $listCarriersResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [
                        (object) ['symbol' => 'CAR1', 'name'=> 'CARRIER1'],
                        (object) ['symbol' => 'CAR2', 'name'=> 'CARRIER2']
                    ]
                ]
            ]
        ];

        $mockSoap->expects($this->any())
            ->method('ListCarriers')
            ->willReturn($listCarriersResult);

        $mockSoap->expects($this->any())
            ->method('Search')
            ->willReturn($searchResult);

        $shipments = $connectshipServiceTestService->getShippingDataByUcc("test");

        $this->assertSame('TEST', $shipments[0]->getTrackingNumber());
        $this->assertSame('TEST2', $shipments[1]->getTrackingNumber());
    }
    public function testGetShippingDataByTrackingNumber(): void
    {

        $mockSoap = $this->getMockFromWsdl(
            __DIR__ . '/connectship_wsdl.xml',
            'AMPServices'
        );

        $connectshipServiceTestService = new ConnectshipServiceTestService($mockSoap);

        $searchResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [ 
                        (object) [
                            'resultData' => (object) [
                                'trackingNumber' => "TEST"
                            ]
                        ], 
                        (object) [
                            'resultData' => (object) [
                                'trackingNumber' => "TEST2"
                        ]] 
                    ]
                ]
            ]
        ];

        $listCarriersResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [
                        (object) ['symbol' => 'CAR1', 'name'=> 'CARRIER1'],
                        (object) ['symbol' => 'CAR2', 'name'=> 'CARRIER2']
                    ]
                ]
            ]
        ];

        $mockSoap->expects($this->any())
            ->method('ListCarriers')
            ->willReturn($listCarriersResult);

        $mockSoap->expects($this->any())
            ->method('Search')
            ->willReturn($searchResult);

        $shipments = $connectshipServiceTestService->getShippingDataByTrackingNumber("test");

        $this->assertSame('TEST', $shipments[0]->getTrackingNumber());
        $this->assertSame('TEST2', $shipments[1]->getTrackingNumber());
    }

    public function testGetShippingDataByDate(): void
    {

        $mockSoap = $this->getMockFromWsdl(
            __DIR__ . '/connectship_wsdl.xml',
            'AMPServices',
            'AMPServicesTest'
        );

        $connectshipServiceTestService = new ConnectshipServiceTestService($mockSoap);

        $searchResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [ 
                        (object) [
                            'resultData' => (object) [
                                'dimension' => (object) [
                                    'unit' => "T",
                                    'height' => "3",
                                    'length' => "4",
                                    'width' => "5"
                                ],
                                'weight' => (object) [
                                    'amount' => "6"
                                ],
                                'total' => (object) [
                                    'amount' => "7"
                                ],
                                'fuelSurcharge' => (object) [
                                    'amount' => "8"
                                ],
                                'consignee' => (object) [
                                    'postalCode' => "1234",
                                    'countryCode' => "US",
                                    'stateProvince' => "PA"
                                ],
                                'shipdate' => '2023',
                                'service' => "SRV1"
                            ]
                        ], 
                        (object) [
                            'resultData' => (object) [
                                'dimension' => (object) [
                                    'unit' => "T1",
                                    'height' => "32",
                                    'length' => "41",
                                    'width' => "52"
                                ],
                                'weight' => (object) [
                                    'amount' => "61"
                                ],
                                'total' => (object) [
                                    'amount' => "72"
                                ],
                                'fuelSurcharge' => (object) [
                                    'amount' => "81"
                                ],
                                'consignee' => (object) [
                                    'postalCode' => "12342",
                                    'countryCode' => "USA",
                                    'stateProvince' => "NJ"
                                ],
                                'shipdate' => '2024',
                                'service' => "SRV2"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $listServicesResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [
                        (object) ['symbol' => 'SRV1', 'name'=> 'SERVICE1'],
                        (object) ['symbol' => 'SRV2', 'name'=> 'SERVICE2']
                    ]
                ]
            ]
        ];

        $listCarriersResult = (object) [
            'result' => (object) [
                'code' => 0,
                'message' => "No Error",
                'resultData' => (object) [
                    'item' => [
                        (object) ['symbol' => 'CAR1', 'name'=> 'CARRIER1'],
                        (object) ['symbol' => 'CAR2', 'name'=> 'CARRIER2']
                    ]
                ]
            ]
        ];

        $mockSoap->expects($this->any())
            ->method('ListServices')
            ->willReturn($listServicesResult);

        $mockSoap->expects($this->any())
            ->method('ListCarriers')
            ->willReturn($listCarriersResult);

        $mockSoap->expects($this->any())
            ->method('Search')
            ->willReturn($searchResult);

        $packages = $connectshipServiceTestService->getShippingDataByDate(new DateTime("yesterday"), new DateTime("now"));

        $this->assertSame(8, count($packages));
        $this->assertSame('12342', $packages[1]->getConsigneePostalCode());
    }
}
