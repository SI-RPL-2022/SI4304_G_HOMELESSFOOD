<?php

namespace Illuminate\View;

class AnonymousComponent extends Component
{
    /**
     * The component view.
     *
     * @var string
     */
    protected $view;

    /**
     * The component data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new anonymous component instance.
     *
     * @param  string  $view
     * @param  array  $data
     * @return void
     */
    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return string
     */
    public function render()
    {
        return $this->view;
    }

    /**
     * Get the data that should be supplied to the view.
     *
     * @return array
     */
    public function data()
    {
        $this->attributes = $this->attributes ?: new ComponentAttributeBag;

<<<<<<< HEAD
        return array_merge(
            optional($this->data['attributes'] ?? null)->getAttributes() ?: [],
            $this->attributes->getAttributes(),
            $this->data,
            ['attributes' => $this->attributes]
        );
=======
        return $this->data + ['attributes' => $this->attributes];
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }
}
