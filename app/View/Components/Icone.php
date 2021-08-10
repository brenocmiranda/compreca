<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Plataforma;

class Icone extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->geral = Plataforma::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.icone')->with('geral', $this->geral);
    }
}
