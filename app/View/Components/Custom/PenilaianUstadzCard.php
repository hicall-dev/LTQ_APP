<?php

namespace App\View\Components\Custom;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PenilaianUstadzCard extends Component
{
    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function render(): View|Closure|string
    {
        return view('components.penilaian.penilaian-ustadz-card');
    }
}
