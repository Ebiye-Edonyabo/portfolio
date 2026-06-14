<div class="dashboard-grid gap-6">
    <!-- Left: Form -->
    <div class="col-span-12 lg:col-span-4 bg-[#121212] border border-[#1f1f1f] rounded-xl p-6 h-fit">
        <h4 class="text-xs font-semibold uppercase tracking-wider text-white mb-4 border-b border-[#1f1f1f] pb-2">
            {{ $form->id ? 'Edit Project Specs' : 'Publish Project' }}
        </h4>
        <form wire:submit="saveProject" class="space-y-4">
            <x-admin.text-input label="Project Title" model="form.title" required />

            <x-admin.textarea-input label="Description" model="form.description" required rows="3" />

            <x-admin.text-input label="Thumbnail Image Path" model="form.image_path" placeholder="images/allsyntax.png" />

            <x-admin.text-input label="Direct Routing URL" model="form.route_url" type="url" placeholder="https://example.com" />

            <x-admin.text-input label="Technologies (Comma separated)" model="form.technologies" placeholder="Laravel, Vue, Tailwind" />

            <!-- Status -->
            <x-admin.dropdown-input label="Status" model="form.status" required>
                @foreach ($statusOptions as $option)
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endforeach
            </x-admin.dropdown-input>

            <div class="flex justify-end gap-2 pt-2">
                @if ($form->id)
                    <button type="button" wire:click="resetFormStates" class="btn btn--secondary py-1.5 px-4 text-xs cursor-pointer">
                        Cancel
                    </button>
                @endif
                <button type="submit" class="btn btn--primary py-1.5 px-4 text-xs cursor-pointer">
                    {{ $form->id ? 'Save Changes' : 'Publish' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Right: Listing -->
    <x-admin.table-card title="Active Projects List" class="col-span-12 lg:col-span-8">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Stack Tags</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $p)
                <tr wire:key="project-item-{{ $p->id }}">
                    <td>
                        @if($p->image_path)
                            <img src="{{ asset($p->image_path) }}" alt="{{ $p->title }}" class="w-10 h-6 object-cover rounded border border-[#1f1f1f]">
                        @else
                            <span class="text-xs text-gray-600 font-mono">None</span>
                        @endif
                    </td>
                    <td class="font-semibold text-white">{{ $p->title }}</td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach ($p->technologies ?? [] as $tech)
                                <span class="badge badge--positive text-[9px]">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <x-admin.status-badge :status="$p->status" />
                    </td>
                    <td class="text-right space-x-2">
                        <button wire:click="editProject({{ $p->id }})" class="text-primary-300 hover:text-primary-100 text-xs font-semibold transition-all cursor-pointer">
                            Edit
                        </button>
                        <button wire:click="deleteProject({{ $p->id }})" wire:confirm="Are you sure?" class="text-red-400 hover:text-red-300 text-xs font-semibold transition-all cursor-pointer">
                            Remove
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-500">No projects published.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>
</div>
