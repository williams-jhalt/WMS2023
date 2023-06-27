<?php

namespace App\Command;

use App\Service\WholesaleService;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\ProductAttachmentRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sync:wholesale',
    description: 'Loads product data from Wholesale site',
)]
class AppSyncWholesaleCommand extends Command
{

    public function __construct(
        private WholesaleService $wholesaleService,
        private ManufacturerRepository $manufacturerRepository,
        private ProductTypeRepository $typeRepository,
        private ProductAttachmentRepository $productAttachmentRepository,
        private ProductRepository $productRepository
        ) {
        parent::__construct();
    }

    protected function configure() {
        $this->setHelp('This command loads product data from Wholesale site if it does not exist in the current database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {

        $output->writeln("Beginning Synchronization");

        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $limit = 100;
        $offset = 0;
        $count = 0;

        $output->writeln("Loading Manufacturers");

        $mfgRepo = $this->manufacturerRepository;

        do {

            $manufacturers = $this->wholesaleService->getManufacturerRepository()->findAll($limit, $offset);
            
            foreach ($manufacturers->getItems() as $prod) {
                $mfg = $mfgRepo->findOneByCode($prod->getCode());
                if ($mfg == null) {
                    $mfg = new Manufacturer();
                    $mfg->setCode($prod->getCode());
                }
                $mfg->setName($prod->getName());
                $mfgRepo->save($mfg);
                $count++;
            }

            $output->writeln($count . " manufacturers have been loaded.");

            $offset += $limit;
        } while (sizeof($manufacturers->getItems()) > 0);

        $offset = 0;
        $count = 0;

        $output->writeln("Loading Types");

        $typeRepo = $this->productTypeRepository;

        do {

            $types = $wholesale->getProductTypeRepository()->findAll($limit, $offset);

            foreach ($types->getItems() as $prod) {
                $type = $typeRepo->findOneByCode($prod->getCode());
                if ($type == null) {
                    $type = new ProductType();
                    $type->setCode($prod->getCode());
                }
                $type->setName($prod->getName());
                $typeRepo->save($type);
                $count++;
            }

            $output->writeln($count . " types have been loaded.");

            $offset += $limit;
        } while (sizeof($types->getItems()) > 0);

        $offset = 0;
        $count = 0;

        $repo2 = $this->productAttachmentRepository;

        $output->writeln("Loading Products");

        do {
            
            $wProducts = $wholesale->getProductRepository()->findAll($limit, $offset);
            
            foreach ($wProducts->getItems() as $wProduct) {
                $product = $this->productRepository->findOneByItemNumber($wProduct->getSku());
                
                if ($product == null) {
                    continue;
                }

                $detail = $product->getDetail();

                $detail->setName($this->cleanName($prod->getName()));
                $detail->setDescription($prod->getDescription());
                $detail->setPackageHeight($prod->getHeight());
                $detail->setPackageLength($prod->getLength());
                $detail->setPackageWidth($prod->getWidth());
                $detail->setPackageLength($prod->getDiameter());
                $detail->setPackageWeight($prod->getWeight());
                $detail->setBrand($prod->getBrand());

                $attributes = $detail->getAttributes();

                $attributes['color'] = $prod->getColor();
                $attributes['material'] = $prod->getMaterial();
                $attributes['product_length'] = $prod->getProductLength();
                $attributes['insertable_length'] = $prod->getInsertableLength();
                $attributes['realistic'] = $prod->getRealistic();
                $attributes['has_balls'] = $prod->getBalls();
                $attributes['suction_cup'] = $prod->getSuctionCup();
                $attributes['harness'] = $prod->getHarness();
                $attributes['vibrating'] = $prod->getVibrating();
                $attributes['double_ended'] = $prod->getDoubleEnded();
                $attributes['circumference'] = $prod->getCircumference();
                
                $product->setDetail($detail);

                $em->persist($product);

                $output->writeln(sprintf("Imported %s", $product->getItemNumber()));

                $count++;
                
            }
            
            $offset += $limit;
            
        } while (($offset - $limit) <= sizeof($wProducts->getItems()));

        $output->writeln($count . " products have been imported.");
    }

    private function cleanName($input) {

        $output = preg_replace("/\(d\)/i", "", $input);
        $output = preg_replace("/out .*/i", "", $output);

        $output = ucwords(strtolower($output));

        return $output;

        return 0;
    }
}
