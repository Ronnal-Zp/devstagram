<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate; 
use App\Models\Comment;

class CreateComment extends Component
{

    public $post;
    public $comments;

    public $comment = '';


    public function mount()
    {
        $this->comments = $this->post->comments;
    }


    public function render()
    {
        return view('livewire.create-comment');
    }


    public function createComment()
    {
        $this->validate(
            [
                'comment' => ['required', 'max:255']
            ],
            [
                'required' => 'Este campo es requerido.',
                'max' => 'Maximo de :max caracteres permitidos.'
            ]
        );

        
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comment
        ]);

        $this->comments->push($comment);
        $this->reset('comment');
    }
}
