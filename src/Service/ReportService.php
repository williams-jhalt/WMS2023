<?php

namespace App\Service;

use DateTime;
use App\Model\Wms\Weborder;
use function GuzzleHttp\json_encode;

class ReportService {

    private $orderService;
    private $productService;

    public function __construct(OrderService $orderService, ProductService $productService) {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function generateReports() {

        // get two weeks
        $startDate = new DateTime("3 weeks ago");
        $endDate = new DateTime("1 day ago");

        $this->generateWebsiteReports($startDate, $endDate);
    }

    /**
     * 
     * @param array $orders
     * @param string $company
     * @return array
     */
    public function calculateWebsiteAverageDaysToShip(array $orders) {

        $daysToShip = [
            'Sunday' => [],
            'Monday' => [],
            'Tuesday' => [],
            'Wednesday' => [],
            'Thursday' => [],
            'Friday' => [],
            'Saturday' => []
        ];

        foreach ($orders as $order) {

            if ($order->getOrderCanceled()) {
                continue;
            }

            if (count($order->getShipments()) > 0 && $order->getShipments()[0]->getShippingDate() !== null) {
                $interval = $order->getShipments()[0]->getShippingDate()->diff($order->getOrderDate());
                $daysToShip[$order->getOrderDate()->format('l')][] = $interval->d;
            }
        }

        $avgDaysToShip = [
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0
        ];

        foreach ($daysToShip as $key => $value) {
            if (count($value) > 0 && is_array($value)) {
                $avgDaysToShip[$key] = array_sum($value) / count($value);
            }
        }

        return $avgDaysToShip;
    }

    public function calculateAverageNumberOfOrders(array $orders) {

        $numberOfOrders = [
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0
        ];

        $weeks = [];

        foreach ($orders as $order) {

            if ($order->getOrderCanceled()) {
                continue;
            }

            $week = $order->getOrderDate()->format('W');
            if (array_search($week, $weeks) === false) {
                $weeks[] = $week;
            }
            $numberOfOrders[$order->getOrderDate()->format('l')] ++;
        }

        $avgNumberOfOrders = [];

        // divide by number of weeks
        foreach ($numberOfOrders as $key => $value) {
            $avgNumberOfOrders[$key] = $value / count($weeks);
        }

        return $avgNumberOfOrders;
    }

    public function calculateOrdersPerHour(array $orders) {

        $ordersPerHour = [];

        $days = [];

        foreach ($orders as $order) {

            if ($order->getOrderCanceled()) {
                continue;
            }

            $day = $order->getOrderDate()->format('z');
            if (array_search($day, $days) === false) {
                $days[] = $day;
            }
            if (!isset($ordersPerHour[$order->getOrderDate()->format('G')])) {
                $ordersPerHour[$order->getOrderDate()->format('G')] = 0;
            }
            $ordersPerHour[$order->getOrderDate()->format('G')] ++;
        }

        foreach ($ordersPerHour as $key => $value) {
            $ordersPerHour[$key] = $value / count($days);
        }

        return $ordersPerHour;
    }

    /**
     * 
     * @param Weborder[] $orders
     */
    public function calculateOrdersByRequestedShippingMethod(array $orders) {

        $shippingMethods = [];

        foreach ($orders as $order) {

            if ($order->getOrderCanceled()) {
                continue;
            }

            if (!isset($shippingMethods[$order->getShipViaCode()])) {
                $shippingMethods[$order->getShipViaCode()] = 0;
            }

            $shippingMethods[$order->getShipViaCode()] ++;
        }

        return $shippingMethods;
    }

    /**
     * 
     * @param Weborder[] $orders
     */
    public function calculateTopSellingProducts(array $orders) {

        $products = [];

        foreach ($orders as $order) {

            if ($order->getOrderCanceled()) {
                continue;
            }

            foreach ($order->getItems() as $item) {

                if (!isset($products[$item->getSku()])) {
                    $products[$item->getSku()] = [
                        'sku' => $item->getSku(),
                        'name' => $item->getName(),
                        'quantity_ordered' => 0,
                        'quantity_shipped' => 0
                    ];
                }

                $products[$item->getSku()]['quantity_ordered'] += $item->getQuantity();
                $products[$item->getSku()]['quantity_shipped'] += $item->getShipped();
            }
        }

        return $products;
    }

    public function calculateFulfilmentRate(array $orders) {

        $data = $this->calculateTopSellingProducts($orders);

        $result = [];

        foreach ($data as $company => $items) {
            if (!isset($result[$company])) {
                $result[$company] = ['ordered' => 0, 'shipped' => 0];
            }
            foreach ($items as $item) {
                $result[$company]['ordered'] += $item['quantity_ordered'];
                $result[$company]['shipped'] += $item['quantity_shipped'];
            }
        }

        $response = [];

        foreach ($result as $key => $data) {
            $response[$key] = $data['shipped'] / $data['ordered'];
        }

        return $response;
    }

    public function generateWebsiteReports(DateTime $startDate, DateTime $endDate) {

        // load orders from website
        $williamsOrders = $this->orderService->getWebsiteOrdersByDate($startDate, $endDate, OrderService::WMS_WILLIAMS);
        $muffsOrders = $this->orderService->getWebsiteOrdersByDate($startDate, $endDate, OrderService::WMS_MUFFS);

        // begin days to ship
        $williamsAvgDaysToShip = $this->calculateWebsiteAverageDaysToShip($williamsOrders);
        $muffsAvgDaysToShip = $this->calculateWebsiteAverageDaysToShip($muffsOrders);

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $avgDaysToShip = [
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null]
        ];

        foreach ($days as $i => $day) {
            $avgDaysToShip[$i]['label'] = $day;
            $avgDaysToShip[$i]['muffs'] = round($muffsAvgDaysToShip[$day], 2);
            $avgDaysToShip[$i]['williams'] = round($williamsAvgDaysToShip[$day], 2);
        }

        file_put_contents(__DIR__ . '/../../../public/data/avgDaysToShip.json', json_encode($avgDaysToShip));
        // end days to ship
        // begin average number of orders
        $williamsAvgNumberOfOrders = $this->calculateAverageNumberOfOrders($williamsOrders);
        $muffsAvgNumberOfOrders = $this->calculateAverageNumberOfOrders($muffsOrders);

        $avgOrdersPerDay = [
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null],
            ['label' => null, 'muffs' => null, 'williams' => null]
        ];

        foreach ($days as $i => $day) {
            $avgOrdersPerDay[$i]['label'] = $day;
            $avgOrdersPerDay[$i]['muffs'] = $muffsAvgNumberOfOrders[$day];
            $avgOrdersPerDay[$i]['williams'] = $williamsAvgNumberOfOrders[$day];
        }

        file_put_contents(__DIR__ . '/../../../public/data/avgOrdersPerDay.json', json_encode($avgOrdersPerDay));
        // end average number of orders
        // begin orders per hour
        $williamsOrdersPerHour = $this->calculateOrdersPerHour($williamsOrders);
        $muffsOrdersPerHour = $this->calculateOrdersPerHour($muffsOrders);

        $ordersPerHour = [];

        for ($hour = 0; $hour < 24; $hour++) {
            $ordersPerHour[] = [
                'label' => $hour,
                'muffs' => isset($muffsOrdersPerHour[$hour]) ? round($muffsOrdersPerHour[$hour], 2) : 0,
                'williams' => isset($williamsOrdersPerHour[$hour]) ? round($williamsOrdersPerHour[$hour], 2) : 0
            ];
        }

        file_put_contents(__DIR__ . '/../../../public/data/ordersPerHour.json', json_encode($ordersPerHour));
        // end orders per hour
        // begin shipping methods
        $williamsShippingMethods = $this->calculateOrdersByRequestedShippingMethod($williamsOrders);
        $muffsShippingMethods = $this->calculateOrdersByRequestedShippingMethod($muffsOrders);

        $shippingMethodData = [
            'williams' => [],
            'muffs' => []
        ];

        foreach ($williamsShippingMethods as $key => $value) {

            $shippingMethodData['williams'][] = [
                'label' => $key,
                'value' => $value
            ];
        }

        foreach ($muffsShippingMethods as $key => $value) {

            $shippingMethodData['muffs'][] = [
                'label' => $key,
                'value' => $value
            ];
        }

        file_put_contents(__DIR__ . '/../../../public/data/shippingMethods.json', json_encode($shippingMethodData));
        // end shipping methods
        // begin top products
        $muffsTopProducts = $this->calculateTopSellingProducts($muffsOrders);
        $williamsTopProducts = $this->calculateTopSellingProducts($williamsOrders);

        file_put_contents(__DIR__ . '/../../../public/data/products.json', json_encode([
            'muffs' => $muffsTopProducts,
            'williams' => $williamsTopProducts
        ]));
        // end top products
    }

}
