<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    public ?int $id = null;

    #[Validate('required|string')]
    public string $title = '';

    #[Validate('required|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $image_path = '';

    #[Validate('nullable|string')]
    public string $route_url = '';

    #[Validate('nullable|string')]
    public string $technologies = '';

    #[Validate('required|string|in:draft,published')]
    public string $status = 'draft';

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
    }

    /**
     * Save the project state (update or create).
     */
    public function save(): void
    {
        $this->validate();

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
