<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VueView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vue:view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat file View Vue.js';

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
        $format = 'FormatView';
        $arg   = $this->argument('name');
        $arg   = str_replace('\\','/',$arg);
        $src_format = resource_path('format_files/'.$format.'.vue');
        $src_new    = resource_path('js/admin/views/'.$arg.'.vue');

        // Cek file
        if ( !file_exists( $src_new ) ) {
            // Buat Folder Sumber
            $dir = 'js/admin/views';
            if( !file_exists( resource_path($dir) ) )
            {
                mkdir( resource_path($dir),777 );
            }
            $src = explode('/', $arg);
            $sum = count($src);

            // Cek Sub Folder
            if ( $sum  > 1 ) {
                $i = 0;
                foreach($src as $key => $value) {
                    if(++$i == $sum) {
                        $name = $value;
                    } else {
                        // Buat Sub Folder
                        $dir .= '/'.$value;
                        if( !file_exists( resource_path($dir) ) )
                        {
                            mkdir( resource_path($dir),777 );
                        }
                    }
                }
            } else {
                $name = $arg;
            }

            // Replace File
            $current = file_get_contents($src_format);
            $current = str_replace($format, $name, $current);
            file_put_contents($src_new, $current);
            $this->info("View Vue.js telah dibuat.");
            return Command::SUCCESS;
        } else {
            $this->error("Oups! View Vue.js sudah ada.");
            return Command::FAILURE;
        }
    }
}
