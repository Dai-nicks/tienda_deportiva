<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class RehashPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rehash:passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-hash any non-bcrypt passwords in tblUsuarios';

    public function handle()
    {
        $this->info('Scanning tblUsuarios for non-hashed passwords...');

        $users = DB::table('tblUsuarios')->get();
        $updated = 0;

        foreach ($users as $u) {
            // Extract current password from either column
            $pw = $u->contrasena ?? ($u->{'contraseña'} ?? '');

            // If it does not look like a bcrypt/argon hash, rehash
            if (!preg_match('/^\$2[ayb]\$|^\$argon/iu', $pw)) {
                $newHash = Hash::make($pw);
                // Write to the preferred column if exists (contrasena), else write to legacy column
                if (Schema::hasColumn('tblUsuarios', 'contrasena')) {
                    DB::table('tblUsuarios')
                        ->where('id_usuario', $u->id_usuario)
                        ->update(['contrasena' => $newHash]);
                } else {
                    DB::table('tblUsuarios')
                        ->where('id_usuario', $u->id_usuario)
                        ->update(['contraseña' => $newHash]);
                }
                $updated++;
                $this->line("Rehashed user: {$u->correo}");
            }
        }

        $this->info("Done. Rehashed passwords for {$updated} users.");

        return 0;
    }
}
