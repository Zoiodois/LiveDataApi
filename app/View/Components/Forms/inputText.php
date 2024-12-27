<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{   
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = 'text',
        string $name,
        string $label = null,
        // string $placeholder = null,
        int $value = null,

    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        // $this->placeholder = $placeholder ?? '';
        $this->value = $value ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-text',[
            'type' => $this->type,
            'name' => $this->name,
            'label' => $this->label,
            // 'placeholder' => $this->placeholder,
            'value' => $this->value,
        ]);
    }
}
