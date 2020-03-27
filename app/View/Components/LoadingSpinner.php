<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LoadingSpinner extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.loading-spinner');
    }
}
