<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ErpService as ErpService;
use App\Service\WholesaleService;

class ProductService {

    /**
     *
     * @var ErpService
     */
    private $erp;

    /**
     * @var WholesaleService
     */
    private $wholesale;

    /**
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ErpService $erp, WholesaleService $wholesale, EntityManagerInterface $em, ProductRepository $productRepository) {
        $this->erp = $erp;
        $this->wholesale = $wholesale;
        $this->em = $em;
        $this->productRepository = $productRepository;
    }

    public function find(int $id) {
        return $this->productRepository->find($id);
    }

    public function findBySearchTerms($searchTerms, $limit = 25, $offset = 0, $company = null, $warehouse = null) {

        $repo = $this->erp->getProductRepository();

        $products = $repo->findByTextSearch($searchTerms, $limit, $offset, $company, $warehouse)->getProducts();

        $result = array();

        foreach ($products as $product) {
            $t = $this->buildProductFromErp($product);
            if ($t !== null) {
                $result[] = $t;
            }
        }

        return $result;
    }

    public function getByItemNumber($itemNumber, $company = null, $warehouse = null) {

        $repo = $this->erp->getProductRepository();

        $product = $repo->getByItemNumber($itemNumber, $company, $warehouse);

        return $this->buildProductFromErp($product);
    }

    /**
     * @param int $limit
     * @param int $offset
     * 
     * @return \App\Model\Product[]
     */
    public function getCommittedProducts($limit = 25, $offset = 0, $company = null, $warehouse = null) {

        $repo = $this->erp->getProductRepository();

        $products = $repo->findCommittedItems($limit, $offset, $company, $warehouse)->getProducts();

        $result = array();

        foreach ($products as $product) {
            $t = new \App\Model\Product();
            $result[] = $this->loadProductFromErp($t, $product);
        }

        return $result;
    }

    private function loadProductFromErp(\App\Model\Product $product, \App\Model\Erp\Product $erpProduct) {

        $product->setBarcode($erpProduct->getBarcode())
                ->setBinLocation($erpProduct->getBinLocation())
                ->setCreatedOn($erpProduct->getCreatedOn())
                ->setDeleted($erpProduct->getDeleted())
                ->setItemNumber($erpProduct->getItemNumber())
                ->setManufacturerCode($erpProduct->getManufacturerCode())
                ->setName($erpProduct->getName())
                ->setProductTypeCode($erpProduct->getProductTypeCode())
                ->setQuantityCommitted($erpProduct->getQuantityCommitted())
                ->setQuantityOnHand($erpProduct->getQuantityOnHand())
                ->setReleaseDate($erpProduct->getReleaseDate())
                ->setUnitOfMeasure($erpProduct->getUnitOfMeasure())
                ->setWarehouse($erpProduct->getWarehouse())
                ->setWholesalePrice($erpProduct->getWholesalePrice())
                ->setWebItem($erpProduct->getWebItem());

        return $product;
    }

    private function loadProductFromWholesale(\App\Model\Product $product, \App\Model\Wholesale\Product $wholesaleProduct) {

        $product->setDescription($wholesaleProduct->getDescription())
                ->setColor($wholesaleProduct->getColor())
                ->setMaterial($wholesaleProduct->getMaterial())
                ->setHeight($wholesaleProduct->getHeight())
                ->setLength($wholesaleProduct->getLength())
                ->setWidth($wholesaleProduct->getWidth())
                ->setDiameter($wholesaleProduct->getDiameter())
                ->setWeight($wholesaleProduct->getWeight())
                ->setKeywords($wholesaleProduct->getKeywords())
                ->setName($wholesaleProduct->getName());

        $wholesaleImages = $this->wholesale->getProductImageRepository()->findBySku($product->getItemNumber());

        $images = array();

        foreach ($wholesaleImages->getItems() as $wholesaleImage) {
            $images[] = $wholesaleImage;
        }

        $product->setImages($images);

        return $product;
    }

    private function loadProductFromDimensions(\App\Model\Product $product, \App\Entity\ProductDimension $dim) {

        if (empty($product->getHeight())) {
            $product->setHeight($dim->getHeight());
        }

        if (empty($product->getLength())) {
            $product->setLength($dim->getLength());
        }

        if (empty($product->getWidth())) {
            $product->setWidth($dim->getWidth());
        }

        if (empty($product->getWeight())) {
            $product->setWeight($dim->getWeight());
        }

        return $product;
    }

    /**
     * 
     * @param \App\Model\Erp\Product $erpProduct
     * @return \App\Entity\Product
     */
    private function buildProductFromErp(\App\Model\Erp\Product $erpProduct): \App\Entity\Product {

        // create new Product model and populate with data from ERP
        $product = new \App\Model\Product();
        $this->loadProductFromErp($product, $erpProduct); // copy information from ERP into new product model

        // load data from wholesale site first
        $wholesaleProduct = $this->wholesale->getProductRepository()->find($product->getItemNumber()); // look for item on Wholesale
        if ($wholesaleProduct !== null) {
            $this->loadProductFromWholesale($product, $wholesaleProduct); // if it exists add the data to the model
        }

        // override any dimensions from the local cubiscan database
        $dimensions = $this->em->getRepository(\App\Entity\ProductDimension::class)->findOneByBarcode($product->getBarcode()); // look for item in local cubiscan db
        if ($dimensions !== null) {
            $this->loadProductFromDimensions($product, $dimensions); // if it exists add the data to the model
        }

        // if product exists in local database load it or create a new product
        $localProduct = $this->em->getRepository(\App\Entity\Product::class)->findOneByItemNumber($product->getItemNumber());

        if ($localProduct == null) {
            $localProduct = new \App\Entity\Product();
            $localProduct->setItemNumber($product->getItemNumber());
        }

        $localProduct->setName($product->getName());
        $localProduct->setWholesalePrice($product->getWholesalePrice());
        $localProduct->setReleaseDate($product->getReleaseDate());
        $localProduct->setBinLocation($product->getBinLocation());
        $localProduct->setQuantityOnHand($product->getQuantityOnHand());
        $localProduct->setQuantityCommitted($product->getQuantityCommitted());
        $localProduct->setDeleted($product->getDeleted());
        $localProduct->setWebItem($product->getWebItem());
        $localProduct->setWarehouse($product->getWarehouse());
        $localProduct->setUnitOfMeasure($product->getUnitOfMeasure());
        $localProduct->setBarcode($product->getBarcode());

        if (!empty($product->getManufacturerCode())) {

            $manufacturer = $this->em->getRepository(\App\Entity\Manufacturer::class)->findOneByCode($product->getManufacturerCode());

            if ($manufacturer == null) {
                $manufacturer = new \App\Entity\Manufacturer();
                $manufacturer->setCode($product->getManufacturerCode());
                $manufacturer->setName($product->getManufacturerCode());
                $whsManufacturer = $this->wholesale->getManufacturerRepository()->find($product->getManufacturerCode());
                if ($whsManufacturer !== null) {
                    $manufacturer->setName($whsManufacturer->getName());
                    $manufacturer->setActive($whsManufacturer->getActive());
                }
                $this->em->persist($manufacturer);
                $this->em->flush();
            }

            $localProduct->setManufacturer($manufacturer);
        }

        if (!empty($product->getProductTypeCode())) {

            $type = $this->em->getRepository(\App\Entity\ProductType::class)->findOneByCode($product->getProductTypeCode());

            if ($type == null) {
                $type = new \App\Entity\ProductType();
                $type->setCode($product->getProductTypeCode());
                $type->setName($product->getProductTypeCode());
                $whsType = $this->wholesale->getProductTypeRepository()->find($product->getProductTypeCode());
                if ($whsType !== null) {
                    $type->setName($whsType->getName());
                    $type->setActive($whsType->getActive());
                }
                $this->em->persist($type);
                $this->em->flush();
            }

            $localProduct->setProductType($type);
        }

        // TODO make this update the attachments if changes detected
        $attachments = $localProduct->getAttachments();

        foreach ($product->getImages() as $image) {            
            $attachment = new \App\Entity\ProductAttachment();
            $attachment->setUrl($image->getImageUrl());
            $attachment->setExplicit($image->getExplicit());
            $attachment->setFileType($image->getFileType());
            $attachment->setFilename($image->getFilename());
            $attachment->setProduct($localProduct);
            $exists = false;
            foreach ($attachments as $test) {
                if ($test->getUrl() == $attachment->getUrl()) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $attachments[] = $attachment;
            }
        }

        $localProduct->setAttachments($attachments);

        $detail = $localProduct->getDetail();

        $detail->setPackageHeight($product->getHeight());
        $detail->setPackageLength($product->getLength());
        $detail->setPackageWidth($product->getWidth());
        $detail->setPackageWeight($product->getWeight());
        $detail->setDimUnit("IN");
        $detail->setWeightUnit("LB");

        if ($wholesaleProduct != null) {
            (!empty($wholesaleProduct->getName())) ? $detail->setName($wholesaleProduct->getName()) : null;
            (!empty($wholesaleProduct->getDescription())) ? $detail->setDescription($wholesaleProduct->getDescription()) : null;
            (!empty($wholesaleProduct->getBrand())) ? $detail->setBrand($wholesaleProduct->getBrand()) : null;           
        } else {
            $detail->setName($localProduct->getName());
        }

        $localProduct->setDetail($detail);

        $this->em->persist($localProduct);
        $this->em->flush();

        if ($wholesaleProduct != null) {
            $this->_updateWholesaleAttributes($localProduct, $wholesaleProduct);
        }

        return $localProduct;
    }

    private function _updateWholesaleAttributes(\App\Entity\Product $product, \App\Model\Wholesale\Product $wholesaleProduct) {
        $attributes = $product->getDetail()->getAttributes();
        $attributesFound = [];

        foreach ($attributes as $attribute) {

            switch ($attribute->getName()) {
                case "product_length":
                    $attributesFound[] = "product_length";
                    $attribute->setValue($wholesaleProduct->getProductLength());                
                    break;
                case "insertable_length":
                    $attributesFound[] = "insertable_length";
                    $attribute->setValue($wholesaleProduct->getInsertableLength());
                    break;
                case "realistic":
                    $attributesFound[] = "realistic";
                    $attribute->setValue($wholesaleProduct->getRealistic());
                    break;
                case "balls":
                    $attributesFound[] = "balls";
                    $attribute->setValue($wholesaleProduct->getBalls());
                    break;                    
                case "suction_cup":
                    $attributesFound[] = "suction_cup";
                    $attribute->setValue($wholesaleProduct->getSuctionCup());
                    break;                    
                case "harness":
                    $attributesFound[] = "harness";
                    $attribute->setValue($wholesaleProduct->getHarness());
                    break;
                case "vibrating":
                    $attributesFound[] = "vibrating";
                    $attribute->setValue($wholesaleProduct->getVibrating());
                    break;                    
                case "double_ended":
                    $attributesFound[] = "double_ended";
                    $attribute->setValue($wholesaleProduct->getDoubleEnded());
                    break;                    
                case "circumference":
                    $attributesFound[] = "circumference";
                    $attribute->setValue($wholesaleProduct->getCircumference());
                    break;

            }

            $this->em->persist($attribute);
        }

        if (!array_search("product_length", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "product_length",
                $wholesaleProduct->getProductLength()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("insertable_length", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "insertable_length",
                $wholesaleProduct->getInsertableLength()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("realistic", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "realistic",
                $wholesaleProduct->getRealistic()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("balls", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "balls",
                $wholesaleProduct->getBalls()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("suction_cup", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "suction_cup",
                $wholesaleProduct->getSuctionCup()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("harness", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "harness",
                $wholesaleProduct->getHarness()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("vibrating", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "vibrating",
                $wholesaleProduct->getVibrating()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("double_ended", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "double_ended",
                $wholesaleProduct->getDoubleEnded()
            );

            $this->em->persist($attribute);
        }

        if (!array_search("circumference", $attributesFound)) {
            $attribute = new \App\Entity\ProductAttribute(
                $product->getDetail(),
                "circumference",
                $wholesaleProduct->getCircumference()
            );

            $this->em->persist($attribute);
        }

    }

}
