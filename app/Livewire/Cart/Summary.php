<?php

namespace App\Livewire\Cart;

class Summary extends CartComponent
{
    public $page = 'sidebar';

    public function mount($page = 'sidebar')
    {
        $this->page = $page;
        $this->refreshData();
    }

    public function render()
    {
        return view('livewire.cart.summary');
    }
}
