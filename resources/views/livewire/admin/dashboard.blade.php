<div>
    <!-- 4 Column Stats row -->
    <div class="dashboard-grid gap-6 mb-8">
        <!-- Messages Count -->
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6 lg:col-span-3" 
            title="Total Messages" 
            value="{{ $messagesCount }}" 
            icon="fa-envelope" 
        />
        <!-- Projects Count -->
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6 lg:col-span-3" 
            title="Projects Published" 
            value="{{ $projectsCount }}" 
            icon="fa-folder" 
        />
        <!-- Tools Count -->
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6 lg:col-span-3" 
            title="Tools Cataloged" 
            value="{{ $toolsCount }}" 
            icon="fa-sliders" 
        />
        <!-- Experiences Count -->
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6 lg:col-span-3" 
            title="Experiences" 
            value="{{ $experiencesCount }}" 
            icon="fa-briefcase" 
        />
    </div>

    <!-- Recent Messages log -->
    <x-admin.table-card title="Recent Inquiries">
        <x-slot:actions>
            <a href="{{ route('admin.messages') }}" class="btn btn--secondary text-xs py-1 px-3">
                Manage Logs
            </a>
        </x-slot:actions>

        <thead>
            <tr>
                <th>Sender</th>
                <th>Email</th>
                <th>Message Payload</th>
                <th>Received At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestMessages as $msg)
                <tr wire:key="msg-{{ $msg->id }}">
                    <td class="font-semibold text-white">{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td class="text-gray-400">{{ Str::limit($msg->message, 80) }}</td>
                    <td>{{ $msg->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">No contact submissions found.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>
</div>
