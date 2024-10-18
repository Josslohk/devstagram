<?php

namespace App\Livewire;

use Livewire\Component;

class Comentarios extends Component
{
    public $post;
    public $comentarios;

    // Escuchar el evento emitido por ComponentA
    protected $listeners = ['actualizarComments' => 'refresh'];

    public function mount($post)
    {
        $this->post = $post;
    }
    public function render()
    {
        $this->comentarios = $this->post->comentarios()->get();
        return view('livewire.comentarios');
    }
}
