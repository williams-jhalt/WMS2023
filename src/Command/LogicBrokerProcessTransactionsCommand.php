<?php

namespace App\Command;

use App\Service\LogicBrokerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'logicbroker:process',
    description: 'Process Transactions through LogicBroker',
)]
class LogicBrokerProcessTransactionsCommand extends Command
{

    public function __construct(private LogicBrokerService $logicBrokerService) {
        parent::_construct();
    }

    protected function configure(): void {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $service = $this->logicBrokerService;
        $output->write("Beginning EDI process...\n");
        $output->write("Retrieving Orders...");
        $service->retrieveOrders();
        $output->write("Done\n");
        $output->write("Acknowledging Receipt...");
        $service->acknowledgeReceipt();
        $output->write("Done\n");
        $output->write("Submitting Shipments...");
        $service->submitShipments();
        $output->write("Done\n");
        $output->write("Submitting Invoices...");
        $service->submitInvoices();
        $output->write("Done\n");        
        $output->write("Updating Inventory...");        
        $service->updateInventory();
        $output->write("Done\n");        
        $output->write("Finished!\n\n");

        return 0;
    }
}
