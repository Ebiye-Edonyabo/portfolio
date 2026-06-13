<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Experience;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ExperienceForm extends Form
{
    public ?int $id = null;

    #[Validate('required|string')]
    public string $period = '';

    #[Validate('required|string')]
    public string $role = '';

    #[Validate('required|string')]
    public string $company = '';

    #[Validate('nullable|string')]
    public string $company_url = '';

    #[Validate('required|string')]
    public string $location = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $responsibilities = '';

    #[Validate('nullable|string')]
    public string $technologies = '';

    #[Validate([
        'projects' => 'array',
        'projects.*.name' => 'required|string|min:1',
        'projects.*.url' => 'required|url',
    ])]
    public array $projects = [];

    /**
     * Load an existing experience into the form.
     */
    public function load(Experience $experience): void
    {
        $this->id = $experience->id;
        $this->period = $experience->period;
        $this->role = $experience->role;
        $this->company = $experience->company;
        $this->company_url = $experience->company_url ?? '';
        $this->location = $experience->location;
        $this->description = $experience->description ?? '';
        $this->responsibilities = implode("\n", $experience->responsibilities ?? []);
        $this->technologies = implode(', ', $experience->technologies ?? []);
        $this->projects = $experience->projects ?? [];
    }

    /**
     * Save the experience state (update or create).
     */
    public function save(): void
    {
        $this->validate();

        $respArray = array_filter(array_map('trim', explode("\n", $this->responsibilities)));
        $techArray = array_filter(array_map('trim', explode(',', $this->technologies)));

        Experience::updateOrCreate(
            ['id' => $this->id],
            [
                'period' => $this->period,
                'role' => $this->role,
                'company' => $this->company,
                'company_url' => $this->company_url ?: null,
                'location' => $this->location,
                'description' => $this->description ?: null,
                'responsibilities' => $respArray,
                'technologies' => $techArray,
                'projects' => $this->projects,
            ]
        );
    }

    /**
     * Add an empty project array structure to the list.
     */
    public function addProject(): void
    {
        $this->projects[] = [
            'name' => '',
            'url' => '',
        ];
    }

    /**
     * Remove a project index from the list.
     */
    public function removeProject(int $index): void
    {
        unset($this->projects[$index]);
        $this->projects = array_values($this->projects);
    }
}
