<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Tool;
use Livewire\Form;

class ToolForm extends Form
{
    public ?int $id = null;

    public string $name = '';

    public string $logo_path = '';

    public $logo_file = null;

    public int $order = 1;

    public string $status = 'draft';

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'logo_path' => $this->logo_file ? 'nullable|string' : 'required|string',
            'logo_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
        ];
    }

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
        $this->logo_file = null;
    }

    /**
     * Save the tool state (update or create).
     */
    public function save(): void
    {
        $this->validate();

        if ($this->logo_file) {
            $path = $this->logo_file->store('logos', 'public');
            $this->logo_path = 'storage/'.$path;
        }

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
