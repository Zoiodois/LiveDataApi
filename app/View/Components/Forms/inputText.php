<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{   
    public string $type;
    public string $name;
    public string $label;
    public string $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct(
       string $type = 'text',
       string $name,
       string $label,
       string $placeholder ="",
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-text');
    }
}
