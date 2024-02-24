<?php

namespace App\Console;

use App\Data\Helper\ServiceStatusList;
use App\Data\Notify\Dal\EmailDal;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
//            Log::info('start sendNewEmails');
            EmailDal::sendNewEmails();
//            Log::info('start sendNewEmails');
        })->everyMinute();

        $schedule->call(function () {$this->generateClientCheckDocuments();})->everyMinute();
        $schedule->call(function () {$this->generatePrepaymentDocuments();})->everyMinute();
        $schedule->call(function () {$this->generateFinalPaymentDocuments();})->everyMinute();
    }

    function generateClientCheckDocuments()
    {
//        Log::info('start generateClientCheckDocuments');
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
//        Log::info('finish generateClientCheckDocuments');
    }

    function generatePrepaymentDocuments()
    {
//        Log::info('start generatePrepaymentDocuments');
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
//        Log::info('finish generatePrepaymentDocuments');
    }

    function generateFinalPaymentDocuments()
    {
//        Log::info('start generateFinalPaymentDocuments');
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
//        Log::info('finish generateFinalPaymentDocuments');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
