<?php

namespace App\Livewire\Admin\Cms\Forms;

use App\Models\Setting;
use Livewire\Form;

class HeroForm extends Form
{
    public string $hello = '';

    public string $title = '';

    public string $description = '';

    public string $available = 'true';

    public string $image_path = '';

    public $image_file = null;

    public function rules(): array
    {
        return [
            'hello' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'available' => 'required|string',
            'image_path' => $this->image_file ? 'nullable|string' : 'required|string',
            'image_file' => 'nullable|image|max:2048',
        ];
    }

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
        $this->image_file = null;
    }

    /**
     * Save form settings directly to the database.
     */
    public function save(): void
    {
        $this->validate();

        if ($this->image_file) {
            $path = $this->image_file->store('hero', 'public');
            $this->image_path = 'storage/'.$path;
        }

        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'hello'], ['value' => $this->hello]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'title'], ['value' => $this->title]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'description'], ['value' => $this->description]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'available'], ['value' => $this->available]);
        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'image_path'], ['value' => $this->image_path]);
    }
}
