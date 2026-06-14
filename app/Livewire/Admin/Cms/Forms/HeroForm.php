<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HeroForm extends Form
{
    #[Validate('required|string')]
    public string $hello = '';

    #[Validate('required|string')]
    public string $title = '';

    #[Validate('required|string')]
    public string $description = '';

    #[Validate('required|string')]
    public string $available = 'true';

    #[Validate('required|string')]
    public string $image_path = '';

    /**
     * Load settings from the database and populate properties.
     */
    public function load(): void
    {
        $settings = Setting::where('group', 'hero')->where('page', 'home')->pluck('value', 'key');

        $this->hello = $settings['hello'] ?? '';
        $this->title = $settings['title'] ?? '';
        $this->description = $settings['description'] ?? '';
        $this->available = $settings['available'] ?? 'true';
        $this->image_path = $settings['image_path'] ?? 'images/bg-remove.png';
    }

    /**
     * Save form settings directly to the database.
     */
    public function save(): void
    {
        $this->validate();

        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'hello'], ['value' => $this->hello]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'title'], ['value' => $this->title]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'description'], ['value' => $this->description]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'available'], ['value' => $this->available]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'image_path'], ['value' => $this->image_path]);
    }
}
