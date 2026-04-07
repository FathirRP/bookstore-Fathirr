<x-layouts.admin title="Customer Service" header="Customer Service">
    <div class="mb-6">
        <p class="text-sm text-slate-400">Kelola percakapan dengan pelanggan</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
        @if($conversations->count())
            <div class="divide-y divide-slate-100">
                @foreach($conversations as $user)
                    @php $lastMsg = $user->messages->first(); @endphp
                    <a href="{{ route('admin.messages.show', $user) }}" class="group flex items-center gap-4 px-6 py-4 hover:bg-slate-50/80 transition-colors {{ $user->unread_count > 0 ? 'bg-emerald-50/30' : '' }}">
                        <div class="relative">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-sm shadow-emerald-500/15 shrink-0">
                                <span class="text-white font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            @if($user->unread_count > 0)
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-slate-800 text-sm truncate group-hover:text-slate-900">{{ $user->name }}</h3>
                                    @if($user->isChatClosed())
                                        <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 bg-red-50 text-red-500 text-[10px] font-bold rounded-md ring-1 ring-inset ring-red-500/10">Ditutup</span>
                                    @endif
                                </div>
                                <span class="text-[11px] text-slate-300 shrink-0 ml-2 font-medium">{{ $lastMsg?->created_at?->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-400 truncate mt-0.5">
                                @if($lastMsg?->is_admin) <span class="text-emerald-500 font-medium">Anda:</span> @endif
                                {{ Str::limit($lastMsg?->content, 60) }}
                            </p>
                        </div>
                        @if($user->unread_count > 0)
                            <span class="w-6 h-6 bg-emerald-500 text-white text-[10px] font-bold rounded-lg flex items-center justify-center shrink-0 shadow-sm shadow-emerald-500/20">{{ $user->unread_count }}</span>
                        @else
                            <svg class="w-4 h-4 text-slate-300 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="px-6 py-20 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                    </div>
                    <p class="font-semibold text-slate-500">Belum ada percakapan</p>
                    <p class="text-sm text-slate-400 mt-1">Pesan dari pengguna akan muncul di sini.</p>
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
