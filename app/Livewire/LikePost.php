<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    //solo cuando monta el componente
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    
    public function like()
    {
        //YA NO ES NECESARIO LIKECONTROLLER
        if($this->post->checkLike(auth()->user())) {
            //elimina likes
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }
        else
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
                //post_id automatico reconce su valor
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
