<?php

namespace App\Command;

use App\Service\ErpServerService;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\ManufacturerRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sync:erp',
    description: 'Loads new products from ERP and updates existing ones.',
)]
class AppSyncErpCommand extends Command
{    
    
    public function __construct(
        private ErpServerService $erp,
        private ProductRepository $repo,
        private ProductTypeRepository $typeRepo,
        private ManufacturerRepository $mfgrRepo
        ) {
        parent::__construct();
    }
    
    protected function configure(): void {
        $this->setHelp('This command loads all products from ERP into the catalog, new products will be created.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {

        $output->writeln("Beginning Synchronization");

        $limit = 1000;
        $offset = 0;
        $count = 0;

        do {

            $products = $this->erp->getProductRepository()->findAll($limit, $offset);

            foreach ($products->getProducts() as $prod) {

                $type = $this->typeRepo->findOneByCode($prod->getProductTypeCode());
                if ($type == null) {
                    $type = new ProductType();
                    $type->setCode($prod->getProductTypeCode());
                    $type->setName($prod->getProductTypeCode());
                    $this->typeRepo->save($type);
                }

                $mfgr = $this->mfgrRepo->findOneByCode($prod->getManufacturerCode());
                if ($mfgr == null) {
                    $mfgr = new Manufacturer();
                    $mfgr->setCode($prod->getManufacturerCode());
                    $mfgr->setName($prod->getManufacturerCode());
                    $this->mfgrRepo->save($mfgr);
                }

                $product = $this->repo->findOneByItemNumber($prod->getItemNumber());
                if ($product == null) {
                    $product = new Product();
                    $product->setItemNumber($prod->getItemNumber());
                }
                $product->setName($prod->getName());
                $product->setReleaseDate($prod->getReleaseDate());
                $product->setBinLocation($prod->getBinLocation());
                $product->setManufacturer($mfgr);
                $product->setProductType($type);
                $product->setCreatedOn($prod->getCreatedOn());
                $product->setDeleted($prod->getDeleted());
                $product->setWebItem($prod->getWebItem());
                $product->setWarehouse($prod->getWarehouse());
                $product->setUnitOfMeasure($prod->getUnitOfMeasure());
                $product->setBarcode($prod->getBarcode());
                $product->setQuantityOnHand($prod->getQuantityOnHand());
                $product->setQuantityCommitted($prod->getQuantityCommitted());
                $product->setWholesalePrice($prod->getWholesalePrice());
                $this->repo->save($product);
                $count++;
            }

            $output->writeln($count . " products have been imported.");

            $offset += $limit;
        } while (sizeof($products->getProducts()) > 0);

        return 0;
    }
}
