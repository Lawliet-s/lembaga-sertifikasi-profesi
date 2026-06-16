<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Data_register;
use App\Http\Controllers\AsesorDashboardController;
use Illuminate\Http\Request;

class AsesorSmokeTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asesor:smoke';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a quick smoke test for asesor controller actions (observasi/penilaian/validasi/rekomendasi)';

    public function handle()
    {
        $this->info('Starting asesor smoke test...');

        $asesor = User::whereHas('roles', function ($q) {
            $q->where('name', 'asesor');
        })->first();

        if (! $asesor) {
            $this->error('No user with role "asesor" found.');
            return 1;
        }

        $this->info('Using asesor id='.$asesor->id.' ('.$asesor->email.')');
        auth()->loginUsingId($asesor->id);

        $register = Data_register::first();
        if (! $register) {
            $this->error('No Data_register records found.');
            return 1;
        }

        $this->info('Using Data_register id='.$register->id);

        $controller = new AsesorDashboardController();

        try {
            $controller->storeObservasi(new Request(['observasi' => '_SMOKE_TEST_OBSERVASI_']), $register);
            $this->info('storeObservasi: OK');

            $controller->updatePenilaian(new Request(['status' => 'Kompeten', 'keterangan' => '_SMOKE_TEST_PENILAIAN_']), $register);
            $this->info('updatePenilaian: OK');

            $controller->storeValidasi(new Request(['validation' => 'approve', 'note' => '_SMOKE_TEST_VALIDASI_']), $register);
            $this->info('storeValidasi: OK');

            $controller->storeRekomendasi(new Request(['recommendation' => 'Kompeten', 'note' => '_SMOKE_TEST_REKOMENDASI_']), $register);
            $this->info('storeRekomendasi: OK');
        } catch (\Exception $e) {
            $this->error('Exception: '.$e->getMessage());
            return 1;
        }

        $this->info('Asesor smoke test completed. Check Data_register record for changes.');
        return 0;
    }
}
