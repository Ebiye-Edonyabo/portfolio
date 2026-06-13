<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.test',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // 2. Seed Settings (Hero Config)
        $settings = [
            [
                'group' => 'hero',
                'page' => 'home',
                'key' => 'hello',
                'value' => 'Hello there! 👋 I\'m Ebiye',
            ],
            [
                'group' => 'hero',
                'page' => 'home',
                'key' => 'title',
                'value' => 'Full-Stack Web Developer',
            ],
            [
                'group' => 'hero',
                'page' => 'home',
                'key' => 'description',
                'value' => 'A software developer with 2+ years experience in PHP and JavaScript, with expertise in modern frameworks such as Laravel, Vue, and Livewire.',
            ],
            [
                'group' => 'hero',
                'page' => 'home',
                'key' => 'available',
                'value' => 'true',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }

        // 3. Seed Tools
        $tools = [
            ['name' => 'HTML', 'logo_path' => 'icons/HTML5.svg', 'order' => 1],
            ['name' => 'CSS', 'logo_path' => 'icons/css.svg', 'order' => 2],
            ['name' => 'TailwindCss', 'logo_path' => 'icons/Tailwind CSS.svg', 'order' => 3],
            ['name' => 'JavaScript', 'logo_path' => 'icons/javascript.svg', 'order' => 4],
            ['name' => 'Laravel', 'logo_path' => 'icons/Laravel.svg', 'order' => 5],
            ['name' => 'Livewire', 'logo_path' => 'icons/Livewire.svg', 'order' => 6],
            ['name' => 'VueJs', 'logo_path' => 'icons/Vue.js.svg', 'order' => 7],
            ['name' => 'Alpine', 'logo_path' => 'icons/Alpine.js.svg', 'order' => 8],
            ['name' => 'MySql', 'logo_path' => 'icons/mysql.svg', 'order' => 9],
            ['name' => 'Postman', 'logo_path' => 'icons/Postman.svg', 'order' => 10],
        ];

        foreach ($tools as $tool) {
            \App\Models\Tool::create($tool);
        }

        // 4. Seed Projects
        $projects = [
            [
                'title' => 'Mo Thompson Consulting',
                'description' => 'Consultancy platform empowering SMEs and enterprises with expert financial advisory, strategic solutions, and digital transformation. Supports grant management, innovation strategy, and mentorship with a free tier.',
                'image_path' => 'images/mothompson.png',
                'route_url' => 'https://mothompsonconsult.com/',
                'technologies' => ['Laravel', 'Livewire', 'Alpine', 'Tailwind'],
            ],
            [
                'title' => 'Graceville Group of Schools',
                'description' => 'A scalable multi-branch school management platform that streamlines academic and administrative operations. Includes dynamic form creation, academic and financial management, and a dedicated parent dashboard — all secured with role-based access.',
                'image_path' => 'images/gracevillp.png',
                'route_url' => 'https://gracevilleschools.org/',
                'technologies' => ['Laravel', 'Vue', 'Inertia', 'Tailwind'],
            ],
            [
                'title' => 'AllSyntax',
                'description' => 'A modern training platform for aspiring software engineers, showcasing web and mobile development programs with mentorship and real-world projects.',
                'image_path' => 'images/allsyntax.png',
                'route_url' => 'https://allsyntax.gygital.com/',
                'technologies' => ['Laravel', 'Livewire', 'Alpine', 'Tailwind'],
            ],
            [
                'title' => 'Atriom Technologies',
                'description' => 'A startup ecosystem enabler that collaborates with founders to build data-driven, innovative solutions — supporting entrepreneurs across Africa with mentorship, digital tools, and technology platforms.',
                'image_path' => 'images/atriom.png',
                'route_url' => 'https://atriomtechnologies.com/',
                'technologies' => ['Laravel', 'Livewire', 'Alpine', 'Tailwind'],
            ],
            [
                'title' => 'SmartWear',
                'description' => 'A static e-commerce platform built at the end of six-month web development training in 2023. This was my first website project.',
                'image_path' => 'images/smartwear.png',
                'route_url' => 'https://smartwear.vercel.app/',
                'technologies' => ['PHP', 'HTML', 'CSS'],
            ],
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }

        // 5. Seed Experiences
        $experiences = [
            [
                'period' => 'Apr 2025 - Nov 2025',
                'role' => 'Back-End Engineer',
                'company' => 'Salient Software Solutions',
                'company_url' => 'https://salientsolutions.tech',
                'location' => 'Asaba, Delta State',
                'description' => 'Contributed to the development and enhancement of two major company projects: AgoPay, a platform for simple and secure installment payments, and Agogo, an e-commerce platform offering flexible purchase options.',
                'responsibilities' => [
                    'Integrated Slack for real-time notifications.',
                    'Built an invitation system managed by agents.',
                    'Developed KYC (Know Your Customer) processes for platform users.',
                    'Integrated third-party APIs for payment and KYC services.',
                    'Enabled multiple payment gateway integrations to allow easy switching during downtimes.',
                    'Optimized database queries to improve performance.',
                    'Tutored interns on the basics of web development and backend technologies using PHP and Laravel.',
                ],
                'technologies' => ['Insomnia', 'PHP', 'Laravel', 'MySQL', 'QOREID API', 'PayStack/FlutterWave API'],
            ],
            [
                'period' => 'Aug 2024 - Apr 2025',
                'role' => 'Full-Stack Web Developer',
                'company' => 'Gygital',
                'company_url' => 'https://gygital.com/',
                'location' => 'Asaba, Delta State',
                'description' => 'Collaborated with the team lead to deliver full-stack solutions for company and clients using modern frameworks and best practices.',
                'responsibilities' => [
                    'Built a software-engineering training platform.',
                    'Developed a startup-support and tech-solutions ecosystem platform.',
                    'Built a strategic consulting platform offering grant management, business registration, and digital-solution services.',
                    'Converted a multi-vendor e-commerce platform from separate Laravel backend and Vue frontend projects into a unified monolithic Laravel and Livewire application.',
                    'Integrated payment-system APIs for seamless online transactions.',
                ],
                'technologies' => ['PHP', 'Laravel', 'Livewire', 'Blade', 'MySQL', 'PayStack'],
            ],
        ];

        foreach ($experiences as $experience) {
            \App\Models\Experience::create($experience);
        }
    }
}
