<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavItem extends Component
{
    public $name;
    public $route;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-item');
    }
}
