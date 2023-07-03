<?php

namespace App\Tests\Repository\Wms;

use PHPUnit\Framework\TestCase;

class WeborderRepositoryTest extends TestCase
{
    public function testGetOrder(): void
    {

        $mockSoap = $this->getMockFromWsdl(
            'http://dropship.williamstradingco.com/WMS/webservices/SOAP/?wsdl',
            'WMS'
        );

        $testDate = new \DateTime("now");

        $mockSoap->expects($this->any())
            ->method('getOrder')
            ->with($this->equalTo(1))
            ->willReturn((object) [
                'billingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                'orderDate' => $testDate->format("Y-m-d\TH:i:sO"),
                'changedOn' => $testDate->format("Y-m-d\TH:i:sO"),
                'orderNumber' => "TEST",
                'reference' => "TEST",
                'reference2' => "TEST",
                'reference3' => "TEST",
                'invoiceNumber' => "TEST",
                'combinedInvoiceNumber' => "TEST",
                'notes' => "TEST",
                'orderShipped' => "TEST",
                'orderProblem' => "TEST",
                'orderCanceled' => "TEST",
                'orderProcessed' => "TEST",
                'customerNumber' => "TEST",
                'shipToFirstName' => "TEST",
                'shipToLastName' => "TEST",
                'shipToAddress1' => "TEST",
                'shipToAddress2' => "TEST",
                'shipToCity' => "TEST",
                'shipToState' => "TEST",
                'shipToZip' => "TEST",
                'shipToCountry' => "TEST",
                'shipToPhone1' => "TEST",
                'shipToPhone2' => "TEST",
                'shipToFax' => "TEST",
                'shipToEmail' => "TEST",
                'billToFirstName' => "TEST",
                'billToLastName' => "TEST",
                'billToAddress1' => "TEST",
                'billToAddress2' => "TEST",
                'billToCity' => "TEST",
                'billToState' => "TEST",
                'billToZip' => "TEST",
                'billToCountry' => "TEST",
                'billToPhone1' => "TEST",
                'billToPhone2' => "TEST",
                'billToFax' => "TEST",
                'billToEmail' => "TEST",
                'shipViaCode' => "TEST",
                'items' => [(object) [
                    'sku' => "TEST",
                    'name' => "TEST",
                    'quantity' => 1,
                    'price' => 2,
                    'shipped' => 1
                ]],
                'shipments' => [(object) [
                    'shippingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'problemDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'trackingNumber' => "TEST",
                    'shippingCost' => 4,
                    'shippingNotes' => "TEST",
                    'shippingMethod' => "TEST",
                    'shippingMethodService' => "TEST",
                    'shipper' => "TEST"
                ]]
            ]);

        $weborderRepository = new WeborderRepositoryTestRepository($mockSoap);

        $result = $weborderRepository->getOrder(1);

        $this->assertSame("TEST", $result->getBillToFirstName());
    }
    
    public function testFindByOrderDate(): void
    {
        $mockSoap = $this->getMockFromWsdl(
            'http://dropship.williamstradingco.com/WMS/webservices/SOAP/?wsdl',
            'WMS'
        );

        $testDate = new \DateTime("now");

        $mockSoap->expects($this->exactly(2))
            ->method('findOrdersByOrderDate')
            ->willReturnOnConsecutiveCalls(
                [(object) [
                    'billingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'orderDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'changedOn' => $testDate->format("Y-m-d\TH:i:sO"),
                    'orderNumber' => "TEST",
                    'reference' => "TEST",
                    'reference2' => "TEST",
                    'reference3' => "TEST",
                    'invoiceNumber' => "TEST",
                    'combinedInvoiceNumber' => "TEST",
                    'notes' => "TEST",
                    'orderShipped' => "TEST",
                    'orderProblem' => "TEST",
                    'orderCanceled' => "TEST",
                    'orderProcessed' => "TEST",
                    'customerNumber' => "TEST",
                    'shipToFirstName' => "TEST",
                    'shipToLastName' => "TEST",
                    'shipToAddress1' => "TEST",
                    'shipToAddress2' => "TEST",
                    'shipToCity' => "TEST",
                    'shipToState' => "TEST",
                    'shipToZip' => "TEST",
                    'shipToCountry' => "TEST",
                    'shipToPhone1' => "TEST",
                    'shipToPhone2' => "TEST",
                    'shipToFax' => "TEST",
                    'shipToEmail' => "TEST",
                    'billToFirstName' => "TEST",
                    'billToLastName' => "TEST",
                    'billToAddress1' => "TEST",
                    'billToAddress2' => "TEST",
                    'billToCity' => "TEST",
                    'billToState' => "TEST",
                    'billToZip' => "TEST",
                    'billToCountry' => "TEST",
                    'billToPhone1' => "TEST",
                    'billToPhone2' => "TEST",
                    'billToFax' => "TEST",
                    'billToEmail' => "TEST",
                    'shipViaCode' => "TEST",
                    'items' => [(object) [
                        'sku' => "TEST",
                        'name' => "TEST",
                        'quantity' => 1,
                        'price' => 2,
                        'shipped' => 1
                    ]],
                    'shipments' => [(object) [
                        'shippingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                        'problemDate' => $testDate->format("Y-m-d\TH:i:sO"),
                        'trackingNumber' => "TEST",
                        'shippingCost' => 4,
                        'shippingNotes' => "TEST",
                        'shippingMethod' => "TEST",
                        'shippingMethodService' => "TEST",
                        'shipper' => "TEST"
                    ]]
                ]],
                [] // second call returns empty array
            );

        $weborderRepository = new WeborderRepositoryTestRepository($mockSoap);

        $result = $weborderRepository->findByOrderDate(new \DateTime("yesterday"), new \DateTime("now"));

        $this->assertSame("TEST", $result[0]->getBillToFirstName());
    }
    
    public function testGetNewOrders(): void
    {        
        $mockSoap = $this->getMockFromWsdl(
            'http://dropship.williamstradingco.com/WMS/webservices/SOAP/?wsdl',
            'WMS'
        );

        $mockSoap->expects($this->once())
            ->method('getNewOrders')
            ->willReturn([1]);

        $testDate = new \DateTime("now");

        $mockSoap->expects($this->once())
            ->method('getOrder')
            ->with($this->equalTo(1))
            ->willReturn((object) [
                'billingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                'orderDate' => $testDate->format("Y-m-d\TH:i:sO"),
                'changedOn' => $testDate->format("Y-m-d\TH:i:sO"),
                'orderNumber' => 1,
                'reference' => "TEST",
                'reference2' => "TEST",
                'reference3' => "TEST",
                'invoiceNumber' => "TEST",
                'combinedInvoiceNumber' => "TEST",
                'notes' => "TEST",
                'orderShipped' => "TEST",
                'orderProblem' => "TEST",
                'orderCanceled' => "TEST",
                'orderProcessed' => "TEST",
                'customerNumber' => "TEST",
                'shipToFirstName' => "TEST",
                'shipToLastName' => "TEST",
                'shipToAddress1' => "TEST",
                'shipToAddress2' => "TEST",
                'shipToCity' => "TEST",
                'shipToState' => "TEST",
                'shipToZip' => "TEST",
                'shipToCountry' => "TEST",
                'shipToPhone1' => "TEST",
                'shipToPhone2' => "TEST",
                'shipToFax' => "TEST",
                'shipToEmail' => "TEST",
                'billToFirstName' => "TEST",
                'billToLastName' => "TEST",
                'billToAddress1' => "TEST",
                'billToAddress2' => "TEST",
                'billToCity' => "TEST",
                'billToState' => "TEST",
                'billToZip' => "TEST",
                'billToCountry' => "TEST",
                'billToPhone1' => "TEST",
                'billToPhone2' => "TEST",
                'billToFax' => "TEST",
                'billToEmail' => "TEST",
                'shipViaCode' => "TEST",
                'items' => [(object) [
                    'sku' => "TEST",
                    'name' => "TEST",
                    'quantity' => 1,
                    'price' => 2,
                    'shipped' => 1
                ]],
                'shipments' => [(object) [
                    'shippingDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'problemDate' => $testDate->format("Y-m-d\TH:i:sO"),
                    'trackingNumber' => "TEST",
                    'shippingCost' => 4,
                    'shippingNotes' => "TEST",
                    'shippingMethod' => "TEST",
                    'shippingMethodService' => "TEST",
                    'shipper' => "TEST"
                ]]
            ]);

        $weborderRepository = new WeborderRepositoryTestRepository($mockSoap);

        $result = $weborderRepository->getNewOrders();

        $this->assertSame("TEST", $result[0]->getBillToFirstName());
    }
}
