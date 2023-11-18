<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $countLikes;


    public function mount()
    {
        $this->isLiked = $this->post->checkLike(auth()->user());
        $this->countLikes = $this->post->likes()->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like() 
    {

        if( $this->isLiked ) {
            // eliminar like
            foreach ($this->post->likes as $like) {
                if(auth()->user()->id == $like->user_id) {
                    $like->delete();
                    $this->isLiked = false;
                }
            }
        } else {
            // crear like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
        }

        $this->countLikes = $this->post->likes()->count();
    }
}
