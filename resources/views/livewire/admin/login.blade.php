<div class="min-h-screen flex items-center justify-center bg-dotted px-4">
    <div class="w-full max-w-md bg-[#121212]/90 backdrop-blur-md border border-[#1f1f1f] p-8 rounded-xl shadow-2xl relative">
        <!-- Brand / Identity Header -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-lg bg-[#1e2d0a] flex items-center justify-center text-primary-300 font-bold text-xl mx-auto mb-3 border border-primary-500/30">
                Æ
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Welcome back</h1>
            <p class="text-sm text-gray-400 mt-1">Access the Ares Admin dashboard</p>
        </div>

        <!-- Login Form -->
        <form wire:submit="login" class="space-y-5">
            @if ($errorMessage)
                <div class="p-3.5 rounded bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-medium">
                    {{ $errorMessage }}
                </div>
            @endif

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold uppercase tracking-wider text-gray-400">Email Address</label>
                <div class="relative">
                    <input type="email" id="email" wire:model="email" required
                        class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-3 rounded-lg text-sm outline-none focus:border-primary-300 transition-all placeholder-gray-600"
                        placeholder="admin@portfolio.test">
                </div>
                @error('email')
                    <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-xs font-semibold uppercase tracking-wider text-gray-400">Password</label>
                <div class="relative">
                    <input type="password" id="password" wire:model="password" required
                        class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-3 rounded-lg text-sm outline-none focus:border-primary-300 transition-all placeholder-gray-600"
                        placeholder="••••••••">
                </div>
                @error('password')
                    <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-3 bg-primary-300 hover:bg-primary-100 text-[#0a0a0a] font-semibold rounded-lg text-sm transition-all flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="login">Sign In</span>
                    <span wire:loading wire:target="login" class="animate-pulse">Authenticating...</span>
                </button>
            </div>
        </form>
    </div>
</div>
