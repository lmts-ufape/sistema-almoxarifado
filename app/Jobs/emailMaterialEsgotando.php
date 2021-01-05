<?php

namespace App\Jobs;

use App\Material;
use App\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class emailMaterialEsgotando implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $usuario, $material;
    public $tries = 10;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario, Material $material)
    {
        $this->usuario = $usuario;
        $this->material = $material;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Illuminate\Support\Facades\Mail::send(new \App\Mail\emailMaterialEsgotando($this->usuario, $this->material));
    }
}
