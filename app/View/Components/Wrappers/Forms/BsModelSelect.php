<?php

namespace App\View\Components\Wrappers\Forms;

use App\Exceptions\NotImplementItemsForSelectInterface;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class BsModelSelect extends Component
{
    public Collection $items;
    public string $default;
    public string $name;
    public string $label;

    public function __construct(string $service, string $default, string $name, string $label)
    {
        $service = app($service);

        if (!($service instanceof ItemsForSelectInterface)) {
            throw new NotImplementItemsForSelectInterface();
        }

        $this->items = $service->getItemsForSelect();
        $this->default = $default;
        $this->name = $name;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.wrappers.forms.bs-model-select');
    }
}
