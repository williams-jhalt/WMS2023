<?php

namespace App\Command;

use App\Service\ExportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export_shipping_data',
    description: 'Export shipment data to CSV',
)]
class AppExportShippingInfoCommand extends Command
{

    public function __construct(private ExportService $exportService) {
        parent::__construct();
    }

    protected function configure(): void {
        $this->addArgument('startDate', InputArgument::REQUIRED, "Start Date")
                ->addArgument('endDate', InputArgument::REQUIRED, "End Date")
                ->addArgument('output', InputArgument::REQUIRED, "Output File");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        
        $startDate = new DateTime($input->getArgument('startDate'));
        $endDate = new DateTime($input->getArgument('endDate'));
        
        $outputFile = new SplFileInfo($input->getArgument('output'));

        $output->write("Beginning shipment export...\n");
        $this->exportService->exportShippingData(
                $startDate, 
                $endDate, 
                $outputFile
        );

        $output->write("Finished!\n\n");

        return 0;
    }
}
