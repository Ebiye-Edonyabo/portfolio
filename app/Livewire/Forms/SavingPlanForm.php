<?php

namespace App\Livewire\Forms;

use App\Enums\SavingsPlatform;
use App\Models\SavingPlan;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SavingPlanForm extends Form
{
    public ?SavingPlan $savingPlan = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate([
        'required',
        'string',
    ])]
    public string $platform_name = 'piggyvest';

    public function rules(): array
    {
        return [
            'platform_name' => ['required', 'string', Rule::enum(SavingsPlatform::class)],
        ];
    }

    public ?string $target = '0.00';

    #[Validate('nullable|string|max:255')]
    public ?string $purpose = null;

    #[Validate('boolean')]
    public bool $is_locked = false;

    #[Validate('nullable|string|max:255')]
    public ?string $duration = null;

    #[Validate('nullable|string|max:255')]
    public ?string $time_line = null;

    public function setSavingPlan(SavingPlan $savingPlan): void
    {
        $this->savingPlan = $savingPlan;
        $this->name = $savingPlan->name;
        $this->platform_name = $savingPlan->platform_name->value;
        $this->target = number_format($savingPlan->target, 2, '.', '');
        $this->purpose = $savingPlan->purpose;
        $this->is_locked = $savingPlan->is_locked;
        $this->duration = $savingPlan->duration;
        $this->time_line = $savingPlan->time_line;
    }

    public function store(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'target' => 'required|numeric|min:0',
        ]);

        SavingPlan::create([
            'name' => $this->name,
            'platform_name' => $this->platform_name,
            'target' => $this->target,
            'purpose' => $this->purpose,
            'is_locked' => $this->is_locked,
            'duration' => $this->duration,
            'time_line' => $this->time_line,
        ]);

        $this->reset(['name', 'platform_name', 'target', 'purpose', 'is_locked', 'duration', 'time_line']);
    }

    public function update(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'target' => 'required|numeric|min:0',
        ]);

        $this->savingPlan->update([
            'name' => $this->name,
            'platform_name' => $this->platform_name,
            'target' => $this->target,
            'purpose' => $this->purpose,
            'is_locked' => $this->is_locked,
            'duration' => $this->duration,
            'time_line' => $this->time_line,
        ]);

        $this->reset(['savingPlan', 'name', 'platform_name', 'target', 'purpose', 'is_locked', 'duration', 'time_line']);
    }

    protected function formatAmount()
    {
        if ($this->target !== null) {
            $this->target = preg_replace('/[^0-9.]/', '', (string) $this->target);
        }
    }
}
