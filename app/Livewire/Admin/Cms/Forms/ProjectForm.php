<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Project;
use Livewire\Form;

class ProjectForm extends Form
{
    public ?int $id = null;

    public string $title = '';

    public string $description = '';

    public string $image_path = '';

    public $image_file = null;

    public string $route_url = '';

    public string $technologies = '';

    public string $status = 'draft';

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'image_path' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'route_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'status' => 'required|string|in:draft,published',
        ];
    }

    /**
     * Load an existing project into the form.
     */
    public function load(Project $project): void
    {
        $this->id = $project->id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->image_path = $project->image_path ?? '';
        $this->route_url = $project->route_url ?? '';
        $this->technologies = implode(', ', $project->technologies ?? []);
        $this->status = $project->status->value;
        $this->image_file = null;
    }

    /**
     * Save the project state (update or create).
     */
    public function save(): void
    {
        $this->validate();

        if ($this->image_file) {
            $path = $this->image_file->store('projects', 'public');
            $this->image_path = 'storage/'.$path;
        }

        $techArray = array_filter(array_map('trim', explode(',', $this->technologies)));

        Project::updateOrCreate(
            ['id' => $this->id],
            [
                'title' => $this->title,
                'description' => $this->description,
                'image_path' => $this->image_path ?: null,
                'route_url' => $this->route_url ?: null,
                'technologies' => $techArray,
                'status' => $this->status,
            ]
        );
    }
}
