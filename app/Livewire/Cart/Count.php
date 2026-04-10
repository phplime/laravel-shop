<?php

namespace App\Livewire\Cart;

use App\Services\CartService;
use Livewire\Component;

class Count extends Component
{
    public $count = 0;

    protected $listeners = ['cart-updated' => 'refreshCount'];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        $this->count = app(CartService::class)->count();
    }

    public function render()
    {
        return view('livewire.cart.count');
    }
}
