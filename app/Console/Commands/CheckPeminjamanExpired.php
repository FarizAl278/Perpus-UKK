<?php

namespace App\Console\Commands;

use App\Models\Peminjaman;
use Illuminate\Console\Command;

class CheckPeminjamanExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-peminjaman-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expired = Peminjaman::where('status', 'pengambilan')
            ->where('expired_at', '<=', now())
            ->get();

            if ($expired->isEmpty()) {
                $this->info('Tidak ada peminjaman yang expired hari ini.');
                return;
            }

        foreach ($expired as $item) {

            // balikin stok buku
            if ($item->book) {
                $item->book->increment('stok');
            }

            // ubah status jadi dibatalkan
            $item->update([
                'status' => 'dibatalkan',
            ]);
        }

        $this->info('Peminjaman expired berhasil diproses.');
    }
}
