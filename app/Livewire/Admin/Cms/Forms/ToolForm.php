<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Tool;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ToolForm extends Form
{
    public ?int $id = null;

    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string')]
    public string $logo_path = '';

    #[Validate('required|integer')]
    public int $order = 1;

    #[Validate('required|string|in:draft,published')]
    public string $status = 'draft';

    /**
     * Load an existing tool into the form.
     */
    public function load(Tool $tool): void
    {
        $this->id = $tool->id;
        $this->name = $tool->name;
        $this->logo_path = $tool->logo_path;
        $this->order = $tool->order;
        $this->status = $tool->status->value;
    }

    /**
     * Save the tool state (update or create).
     */
    public function save(): void
    {
        $this->validate();

        Tool::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
                'logo_path' => $this->logo_path,
                'order' => $this->order,
                'status' => $this->status,
            ]
        );
    }
}
