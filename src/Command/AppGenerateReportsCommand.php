<?php

namespace App\Command;

use App\Service\ReportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generate_reports',
    description: 'Generate reports',
)]
class AppGenerateReportsCommand extends Command
{

    public function __construct(private ReportService $reportService) {
        parent::__construct();
    }

    protected function configure() {}

    protected function execute(InputInterface $input, OutputInterface $output): int {
                
        $output->write("Beginning report generation...\n");
        try {
            $this->reportService->generateReports();
        } catch (Exception $e) {
            $output->writeln("There was an error generating the reports: " . $e->getMessage());
            $output->write($e->getTraceAsString());
        }
        $output->write("Finished!\n\n");

        return 0;
    }
}
