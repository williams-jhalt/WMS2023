<?php

namespace App\Command;

use DateTime;
use SplFileInfo;
use App\Service\ExportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export_invoices',
    description: 'Export invoices to CSV',
)]
class AppExportInvoicesCommand extends Command
{

    public function __construct(private ExportService $exportService) {
        parent::__construct();
    }

    protected function configure() {
        $this->addArgument('customerNumber', InputArgument::REQUIRED, "Customer Number")
                ->addArgument('startDate', InputArgument::REQUIRED, "Start Date")
                ->addArgument('endDate', InputArgument::REQUIRED, "End Date")
                ->addArgument('headerFile', InputArgument::REQUIRED, "Header Filename")
                ->addArgument('detailFile', InputArgument::REQUIRED, "Detail Filename");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        
        $startDate = new DateTime($input->getArgument('startDate'));
        $endDate = new DateTime($input->getArgument('endDate'));
        
        $headerFile = new SplFileInfo($input->getArgument('headerFile'));
        $detailFile = new SplFileInfo($input->getArgument('detailFile'));

        $output->write("Beginning invoice export...\n");
        $this->exportService->exportInvoiceData(
                $input->getArgument('customerNumber'), 
                $startDate, 
                $endDate, 
                false,
                $headerFile,
                $detailFile
        );

        $output->write("Finished!\n\n");

        return 0;
    }
}
