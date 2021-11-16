<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InitLaundeni extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:laundeni';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build Laundeni until ready to use.';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Building Laundeni... by Albet Novendo');
        $start_time = microtime(true);
        if (!file_exists('.env')) {
            $this->info('File .env tidak terdeteksi. Membatalkan...');
            copy('.env.example', '.env');
            Artisan::call('key:generate');
            exit();
        }
        if (!DB::connection()->getDatabaseName()) {
            $this->info('Tidak bisa tersambung ke database. Mohon cek konfigurasi .env');
            exit();
        }
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        $final_time = (microtime(true) - $start_time);
        $this->info('Laundeni berhasil dibuild dalam: ' . $final_time);
    }
}
