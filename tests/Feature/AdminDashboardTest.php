<?php

namespace Tests\Feature;

use App\Livewire\Admin\Cms\Experiences;
use App\Livewire\Admin\Cms\Hero;
use App\Livewire\Admin\Cms\Projects;
use App\Livewire\Admin\Cms\Tools;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Messages;
use App\Livewire\ContactForm;
use App\Mail\ContactMail;
use App\Models\Experience as ExperienceModel;
use App\Models\Message as MessageModel;
use App\Models\Project as ProjectModel;
use App\Models\Setting;
use App\Models\Tool as ToolModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_guest_can_view_login_page(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSeeLivewire(Login::class);
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('password'),
        ]);

        Livewire::test(Login::class)
            ->set('email', 'admin@portfolio.test')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('password'),
        ]);

        Livewire::test(Login::class)
            ->set('email', 'admin@portfolio.test')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertSet('errorMessage', 'The provided credentials do not match our records.');

        $this->assertGuest();
    }

    public function test_contact_form_saves_message_and_sends_notification(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('message', 'Hello, this is a test message.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello, this is a test message.',
        ]);

        Mail::assertSent(ContactMail::class);
    }

    public function test_admin_can_update_hero_settings(): void
    {
        $user = User::factory()->create();

        Setting::updateOrCreate(['group' => 'hero', 'page' => 'home', 'key' => 'hello'], ['value' => 'Old Hello']);

        Livewire::actingAs($user)
            ->test(Hero::class)
            ->set('form.hello', 'New Hello Greeting')
            ->set('form.title', 'Architect')
            ->set('form.description', 'Bio description text')
            ->set('form.available', 'false')
            ->call('saveHero')
            ->assertDispatched('notification', message: 'Hero settings updated successfully!');

        $this->assertDatabaseHas('settings', [
            'group' => 'hero',
            'page' => 'home',
            'key' => 'hello',
            'value' => 'New Hello Greeting',
        ]);
        $this->assertDatabaseHas('settings', [
            'group' => 'hero',
            'page' => 'home',
            'key' => 'title',
            'value' => 'Architect',
        ]);
        $this->assertDatabaseHas('settings', [
            'group' => 'hero',
            'page' => 'home',
            'key' => 'available',
            'value' => 'false',
        ]);
    }

    public function test_admin_can_manage_tools(): void
    {
        $user = User::factory()->create();

        // 1. Create/Add Tool
        Livewire::actingAs($user)
            ->test(Tools::class)
            ->set('form.name', 'React')
            ->set('form.logo_path', 'icons/react.svg')
            ->set('form.order', 11)
            ->call('saveTool')
            ->assertDispatched('notification', message: 'Tool saved successfully!');

        $this->assertDatabaseHas('tools', [
            'name' => 'React',
            'logo_path' => 'icons/react.svg',
            'order' => 11,
        ]);

        $tool = ToolModel::where('name', 'React')->first();

        // 2. Edit Tool
        Livewire::actingAs($user)
            ->test(Tools::class)
            ->call('editTool', $tool->id)
            ->assertSet('form.name', 'React')
            ->set('form.name', 'React Native')
            ->call('saveTool')
            ->assertDispatched('notification', message: 'Tool saved successfully!');

        $this->assertDatabaseHas('tools', [
            'id' => $tool->id,
            'name' => 'React Native',
        ]);

        // 3. Delete Tool
        Livewire::actingAs($user)
            ->test(Tools::class)
            ->call('deleteTool', $tool->id)
            ->assertDispatched('notification', message: 'Tool removed successfully!');

        $this->assertDatabaseMissing('tools', [
            'id' => $tool->id,
        ]);
    }

    public function test_admin_can_manage_projects(): void
    {
        $user = User::factory()->create();

        // 1. Add Project
        Livewire::actingAs($user)
            ->test(Projects::class)
            ->set('form.title', 'New Project')
            ->set('form.description', 'Project description text')
            ->set('form.image_path', 'images/new.png')
            ->set('form.route_url', 'https://newproject.com')
            ->set('form.technologies', 'PHP, Laravel, Livewire')
            ->call('saveProject')
            ->assertDispatched('notification', message: 'Project saved successfully!');

        $this->assertDatabaseHas('projects', [
            'title' => 'New Project',
            'description' => 'Project description text',
            'image_path' => 'images/new.png',
            'route_url' => 'https://newproject.com',
        ]);

        $project = ProjectModel::where('title', 'New Project')->first();
        $this->assertEquals(['PHP', 'Laravel', 'Livewire'], $project->technologies);

        // 2. Edit Project
        Livewire::actingAs($user)
            ->test(Projects::class)
            ->call('editProject', $project->id)
            ->assertSet('form.title', 'New Project')
            ->set('form.title', 'Updated Project')
            ->call('saveProject')
            ->assertDispatched('notification', message: 'Project saved successfully!');

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Project',
        ]);

        // 3. Delete Project
        Livewire::actingAs($user)
            ->test(Projects::class)
            ->call('deleteProject', $project->id)
            ->assertDispatched('notification', message: 'Project removed successfully!');

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    public function test_admin_can_manage_experiences(): void
    {
        $user = User::factory()->create();

        // 1. Add Experience
        Livewire::actingAs($user)
            ->test(Experiences::class)
            ->set('form.period', '2026 - 2027')
            ->set('form.role', 'Staff Engineer')
            ->set('form.company', 'Tech Corp')
            ->set('form.location', 'Lagos, Nigeria')
            ->set('form.description', 'Lead backend team')
            ->set('form.responsibilities', "Design architecture.\nReview code.")
            ->set('form.technologies', 'Laravel, Go, Docker')
            ->set('form.projects', [
                [
                    'name' => 'Project Alpha',
                    'url' => 'https://alpha.test',
                ],
            ])
            ->call('saveExperience')
            ->assertDispatched('notification', message: 'Experience saved successfully!');

        $this->assertDatabaseHas('experiences', [
            'period' => '2026 - 2027',
            'role' => 'Staff Engineer',
            'company' => 'Tech Corp',
            'location' => 'Lagos, Nigeria',
            'description' => 'Lead backend team',
        ]);

        $exp = ExperienceModel::where('company', 'Tech Corp')->first();
        $this->assertEquals(['Design architecture.', 'Review code.'], $exp->responsibilities);
        $this->assertEquals(['Laravel', 'Go', 'Docker'], $exp->technologies);
        $this->assertEquals([
            [
                'name' => 'Project Alpha',
                'url' => 'https://alpha.test',
            ],
        ], $exp->projects);

        // 2. Edit Experience
        Livewire::actingAs($user)
            ->test(Experiences::class)
            ->call('editExperience', $exp->id)
            ->assertSet('form.role', 'Staff Engineer')
            ->assertSet('form.projects', [
                [
                    'name' => 'Project Alpha',
                    'url' => 'https://alpha.test',
                ],
            ])
            ->set('form.role', 'Principal Engineer')
            ->set('form.projects', [
                [
                    'name' => 'Project Beta',
                    'url' => 'https://beta.test',
                ],
            ])
            ->call('saveExperience')
            ->assertDispatched('notification', message: 'Experience saved successfully!');

        $this->assertDatabaseHas('experiences', [
            'id' => $exp->id,
            'role' => 'Principal Engineer',
        ]);

        $exp->refresh();
        $this->assertEquals([
            [
                'name' => 'Project Beta',
                'url' => 'https://beta.test',
            ],
        ], $exp->projects);

        // 3. Test dynamic project editing actions directly on the component
        Livewire::actingAs($user)
            ->test(Experiences::class)
            ->call('addProject')
            ->assertSet('form.projects', [
                [
                    'name' => '',
                    'url' => '',
                ],
            ])
            ->set('form.projects.0.name', 'Dynamic Project')
            ->set('form.projects.0.url', 'https://dynamic.test')
            ->call('addProject')
            ->assertSet('form.projects', [
                [
                    'name' => 'Dynamic Project',
                    'url' => 'https://dynamic.test',
                ],
                [
                    'name' => '',
                    'url' => '',
                ],
            ])
            ->call('removeProject', 0)
            ->assertSet('form.projects', [
                [
                    'name' => '',
                    'url' => '',
                ],
            ]);

        // 4. Delete Experience
        Livewire::actingAs($user)
            ->test(Experiences::class)
            ->call('deleteExperience', $exp->id)
            ->assertDispatched('notification', message: 'Experience record removed successfully!');

        $this->assertDatabaseMissing('experiences', [
            'id' => $exp->id,
        ]);
    }

    public function test_admin_can_delete_message(): void
    {
        $user = User::factory()->create();
        $message = MessageModel::create([
            'name' => 'Spammer',
            'email' => 'spam@spam.com',
            'message' => 'Buy something!',
        ]);

        Livewire::actingAs($user)
            ->test(Messages::class)
            ->call('deleteMessage', $message->id)
            ->assertDispatched('notification', message: 'Message deleted successfully!');

        $this->assertDatabaseMissing('messages', [
            'id' => $message->id,
        ]);
    }

    public function test_admin_can_view_dashboard_overview_and_routed_pages(): void
    {
        $user = User::factory()->create();

        // Seed some data to populate counts
        MessageModel::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Hello there!',
        ]);

        ProjectModel::create([
            'title' => 'Project A',
            'description' => 'Cool stuff',
            'image_path' => 'cool.png',
            'route_url' => 'https://cool.com',
            'technologies' => ['Laravel'],
        ]);

        // Assert overview routes load correct statistics and content
        $this->actingAs($user)
            ->get('/admin')
            ->assertStatus(200)
            ->assertSee('Jane Doe')
            ->assertSee('Total Messages')
            ->assertSee('1');

        // Assert other routed pages are accessible
        $this->actingAs($user)->get('/admin/hero')->assertStatus(200)->assertSeeLivewire(Hero::class);
        $this->actingAs($user)->get('/admin/tools')->assertStatus(200)->assertSeeLivewire(Tools::class);
        $this->actingAs($user)->get('/admin/projects')->assertStatus(200)->assertSeeLivewire(Projects::class);
        $this->actingAs($user)->get('/admin/experiences')->assertStatus(200)->assertSeeLivewire(Experiences::class);
        $this->actingAs($user)->get('/admin/messages')->assertStatus(200)->assertSeeLivewire(Messages::class);
    }

    public function test_admin_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
