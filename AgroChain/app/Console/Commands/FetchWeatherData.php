<?php

namespace App\Console\Commands;

use App\InsuranceApplication;
use App\InsuranceVerification;
use App\InsurancePolicy;
use Illuminate\Console\Command;
use \GuzzleHttp\Client;
use Carbon\Carbon;


class FetchWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch weather data daily for the farm';

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
        $districts = [
            ["Arghakhanchi", 27.9, 83.2],
            ["Baglung", 28.3, 83.6],
            ["Baitadi", 29.5, 80.5],
            ["Bajang", 29.6, 81.2],
            ["Banke", 28.1, 81.7],
            ["Bara", 27.15, 84.95],
            ["Bardiya", 28.45, 81.3],
            ["Bhaktapur", 27.7, 85.5],
            ["Chitawan", 27.7, 84.4],
            ["Dadeldhura", 29.3, 80.6],
            ["Dailekh", 28.8, 81.7],
            ["Dang", 28.05, 82.4],
            ["Darchula", 29.9, 80.6],
            ["Dhading", 27.7, 85.2],
            ["Dhankuta", 27, 87.3],
            ["Dhanusa", 26.7, 85.9],
            ["Dolkha", 27.6, 86.2],
            ["Dolpa", 29, 82.9],
            ["Doti", 29.3, 80.95],
            ["Gorkha", 28, 84.6],
            ["Gulmi", 28.1, 83.2],
            ["Humla", 30, 81.8],
            ["Ilam", 26.9, 88],
            ["Jhapa", 26.7, 87.9],
            ["Jumla", 29.3, 82.2],
            ["Kabhre", 27.6, 85.6],
            ["Kailali", 28.7, 80.8],
            ["Kanchanpur", 29, 80.2],
            ["Kaski", 28.2, 83.9],
            ["Kathmandu", 27.73, 85.37],
            ["Lalitpur", 27.63, 85.33],
            ["Lamjung", 28.3, 84.4],
            ["Mahottari", 26.7, 85.8],
            ["Makwanpur", 27.4, 85],
            ["Manang", 28.6, 84.2],
            ["Morang", 26.5, 87.3],
            ["Mugu", 29.5, 82.1],
            ["Mustang", 28.7, 83.67],
            ["Myagdi", 28.4, 83.6],
            ["Nawalparasi", 27.6, 84],
            ["Nuwakot", 27.85, 85.25],
            ["Okhaldhunga", 27.3, 86.5],
            ["Palpa", 27.9, 83.5],
            ["Panchther", 27.1, 87.8],
            ["Parbat", 28.2, 83.7],
            ["Rasuwa", 28.1, 85.3],
            ["Routahat", 26.8, 85.3],
            ["Rukum", 28.65, 82.35],
            ["Rupandehi", 27.57, 83.47],
            ["Salyan", 28.4, 82.1],
            ["Sankhuwasabha", 27.3, 87.3],
            ["Saptari", 26.6, 86.8],
            ["Sarlahi", 27, 85.45],
            ["Sindhuli", 27.2, 85.9],
            ["Solukhumbu", 28, 86.8],
            ["Sunsari", 26.75, 87.3],
            ["Surkhet", 28.75, 81.4],
            ["Syangja", 28, 83.85],
            ["Tanahun", 28, 84.1],
            ["Taplejung", 27.4, 87.7],
            ["Terhathum", 27.1, 87.5],
            ["Udayapur", 26.9, 86.5]
        ];
        $client = new client();
//        $policies = InsurancePolicy::where('status', 0)->get();
//        $verificationids = [];
//        foreach ($policies as $policy){
//            array_push($verificationids, $policy['verification_id']);
//        }
//
//        $verifications = InsuranceVerification::whereIn('id', $verificationids)->get();
//        $applicationids = [];
//        foreach ($verifications as $verification){
//            array_push($applicationids, $verification['application_id']);
//        }
//
//        $applications = InsuranceApplication::whereIn('id', $applicationids)->get();
//        $responses = [];

        foreach ($districts as $district){
            $api = 'api.weatherapi.com/v1/history.json?key=f2134f7f7bcb4eae9e4165332220402 &q='. $district[1] .','. $district[2].'&dt=' . Carbon::now()->format('Y-m-d');
            $response = $client->get($api);
            $decoded = json_decode($response->getBody(), true);
            $this->info(date("m/d/Y", strtotime($decoded["forecast"]["forecastday"][0]["date"]) ) . ',' . date("Y", strtotime($decoded["forecast"]["forecastday"][0]["date"]) ). ',' . date("m", strtotime($decoded["forecast"]["forecastday"][0]["date"]) ) . ',' . $district[0]. ',' .$decoded["forecast"]["forecastday"]["0"]["day"]["totalprecip_mm"]);

        }
    }
}
