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
    name: 'app:upload_invoices',
    description: 'Export invoices to FTP',
)]
class AppUploadInvoicesCommand extends Command
{

    public function __construct(private ExportService $exportService) {
        parent::__construct();
    }

    protected function configure(): void {
        $this->addArgument('customerNumber', InputArgument::REQUIRED, "Customer Number")
                ->addArgument('hostname', InputArgument::REQUIRED, "FTP Hostname")
                ->addArgument('username', InputArgument::REQUIRED, "FTP Username")
                ->addArgument('password', InputArgument::REQUIRED, "FTP Password")
                ->addArgument('startDate', InputArgument::OPTIONAL, "Start Date")
                ->addArgument('endDate', InputArgument::OPTIONAL, "End Date");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {

        if ($input->hasArgument('startDate')) {
            $startDate = new DateTime($input->getArgument('startDate'));
        } else {
            $startDate = new DateTime("yesterday");
        }

        if ($input->hasArgument('endDate')) {
            $endDate = new DateTime($input->getArgument('endDate'));
        } else {
            $endDate = new DateTime("tomorrow");
        }

        $service = $this->exportService;
        $output->write("Beginning invoice export...\n");
        $service->uploadInvoicesToFtp(
                $input->getArgument('customerNumber'), $startDate, $endDate, $input->getArgument('hostname'), $input->getArgument('username'), $input->getArgument('password')
        );

        $output->write("Finished!\n\n");

        return 0;
    }
}
