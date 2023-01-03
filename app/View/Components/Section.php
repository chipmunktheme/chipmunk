<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Section extends Component
{
    /**
     * The section type.
     *
     * @var string|array
     */
    public $type;

    /**
     * The section class.
     *
     * @var string
     */
    public $class;

    /**
     * The section id.
     *
     * @var string
     */
    public $id;

    /**
     * Create a new component instance.
     *
     * @param  string|array  $type
     * @param  string  $class
     * @param  string  $id
     *
     * @return void
     */
    public function __construct($type = '', $class = '', $id = '')
    {
        $this->type = $type;
        $this->class = $class;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section');
    }
}
