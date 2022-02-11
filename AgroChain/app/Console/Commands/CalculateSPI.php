<?php

namespace App\Console\Commands;

use App\ClaimNotification;
use App\InsuranceApplication;
use App\InsurancePolicy;
use App\InsuranceVerification;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CalculateSPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:spi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate SPI monthly for insurance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $policies = InsurancePolicy::all();
        $verificationids = [];
        foreach ($policies as $policy){
            array_push($verificationids, $policy['verification_id']);
        }

        $verifications = InsuranceVerification::whereIn('id', $verificationids)->get();
        $applicationids = [];
        foreach ($verifications as $verification){
            array_push($applicationids, $verification['application_id']);
        }

        $applications = InsuranceApplication::whereIn('id', $applicationids)->get();
        $process = new Process(['python', 'D:\Blockchain\AgroChain Project\Climate Analysis\generate_average.py']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        foreach ($applications as $application) {
            $process = new Process(['python', 'D:\Blockchain\AgroChain Project\Climate Analysis\spi.py', $application['district']]);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $path = 'D:\Blockchain\AgroChain Project\Climate Analysis\spi_output\output'.$application['district'].'.csv';
            $data = array_map('str_getcsv', file($path));
            $csv_data = array_slice($data, 0, 2);
            $spi1 = $csv_data[1][5];
            $spi3 = $csv_data[1][6];
            if($spi3 < -1.0 || $spi1 < -1.0 || $spi3 > 1.5 || $spi1 > 1.5){
                $notification = new ClaimNotification();
                $notification->application_id = $application['id'];
                $notification->farmer_id = $application['farmer_id'];
                $notification->spi1 = $spi1;
                $notification->spi3 = $spi3;
                $notification->save();
            }

        }


    }


}
