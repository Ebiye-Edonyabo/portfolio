<div class="table-container">
    <div class="px-6 py-4 border-b border-[#1f1f1f]">
        <h3 class="text-xs font-bold text-white tracking-wide uppercase">All Contact Submissions</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Email Address</th>
                    <th>Message Payload</th>
                    <th>Received At</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allMessages as $msg)
                    <tr wire:key="msg-log-{{ $msg->id }}">
                        <td class="font-semibold text-white">{{ $msg->name }}</td>
                        <td>
                            <a href="mailto:{{ $msg->email }}" class="text-primary-300 hover:text-primary-100 transition-all font-medium">
                                {{ $msg->email }}
                            </a>
                        </td>
                        <td class="text-gray-300 text-xs leading-relaxed max-w-lg">{{ $msg->message }}</td>
                        <td class="text-xs text-gray-400">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                        <td class="text-right">
                            <button wire:click="deleteMessage({{ $msg->id }})" wire:confirm="Are you sure you want to delete this message?" 
                                class="text-red-400 hover:text-red-300 text-xs font-semibold transition-all">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 text-gray-500">No contact messages received yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
