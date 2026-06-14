<div>
    <!-- 4 Column Stats row -->
    <div class="dashboard-grid gap-6 mb-8">
        <!-- Messages Count -->
        <div class="stat-card col-span-12 sm:col-span-6 lg:col-span-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Messages</span>
                <div class="w-7 h-7 rounded bg-[#1e2d0a] flex items-center justify-center">
                    <i class="fa-solid fa-envelope text-primary-300 text-xs"></i>
                </div>
            </div>
            <div class="stat-card__value">{{ $messagesCount }}</div>
        </div>
        <!-- Projects Count -->
        <div class="stat-card col-span-12 sm:col-span-6 lg:col-span-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Projects Published</span>
                <div class="w-7 h-7 rounded bg-[#1e2d0a] flex items-center justify-center">
                    <i class="fa-solid fa-folder text-primary-300 text-xs"></i>
                </div>
            </div>
            <div class="stat-card__value">{{ $projectsCount }}</div>
        </div>
        <!-- Tools Count -->
        <div class="stat-card col-span-12 sm:col-span-6 lg:col-span-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Tools Cataloged</span>
                <div class="w-7 h-7 rounded bg-[#1e2d0a] flex items-center justify-center">
                    <i class="fa-solid fa-sliders text-primary-300 text-xs"></i>
                </div>
            </div>
            <div class="stat-card__value">{{ $toolsCount }}</div>
        </div>
        <!-- Experiences Count -->
        <div class="stat-card col-span-12 sm:col-span-6 lg:col-span-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Experiences</span>
                <div class="w-7 h-7 rounded bg-[#1e2d0a] flex items-center justify-center">
                    <i class="fa-solid fa-briefcase text-primary-300 text-xs"></i>
                </div>
            </div>
            <div class="stat-card__value">{{ $experiencesCount }}</div>
        </div>
    </div>

    <!-- Recent Messages log -->
    <div class="table-container">
        <div class="px-6 py-4 border-b border-[#1f1f1f] flex items-center justify-between">
            <h3 class="text-sm font-bold text-white tracking-wide uppercase">Recent Inquiries</h3>
            <a href="{{ route('admin.messages') }}" class="btn btn--secondary text-xs py-1 px-3">
                Manage Logs
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
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
            </table>
        </div>
    </div>
</div>
