<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class CommentPost extends Component
{
    public $comentario;
    public $post;

    protected $rules = [
        'comentario' => 'required|max:255'
    ];
    public function Comentar()
    {
        $this->validate();
        // dd($this->comentario);
        Comentario::create([
            'comentario' => $this->comentario,
            'post_id' =>  $this->post->id,
            'user_id' => auth()->user()->id
        ]);
        $this->comentario = "";
        session()->flash('message', 'Comentario enviado');
        $this->dispatch('actualizarComments');
    }
    public function render()
    { 
        return view('livewire.comment-post');
    }
}
