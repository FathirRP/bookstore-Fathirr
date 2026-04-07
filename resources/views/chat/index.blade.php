<x-layouts.app title="Customer Service">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col" style="height: 75vh;">
            {{-- Header chat --}}
            <div class="px-6 py-4 bg-stone-900 text-white flex items-center gap-3">
                <div class="p-2 bg-white/20 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg">Customer Service</h1>
                    <p class="text-xs text-stone-400">Kami siap membantu Anda</p>
                </div>
                <div class="ml-auto flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs text-stone-400">Online</span>
                </div>
            </div>

            {{-- Daftar pesan --}}
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 bg-gray-50" id="chat-messages">
                @if($messages->isEmpty())
                    <div class="flex flex-col items-center justify-center h-full text-gray-400">
                        <svg class="w-16 h-16 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p class="font-medium">Belum ada pesan</p>
                        <p class="text-sm mt-1">Mulai percakapan dengan tim kami!</p>
                    </div>
                @else
                    @foreach($messages as $msg)
                        @if($msg->is_admin)
                            {{-- Pesan dari admin --}}
                            <div class="flex items-end gap-2 max-w-[80%]">
                                <div class="w-7 h-7 rounded-full bg-emerald-700 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div>
                                    <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-4 py-2.5 shadow-sm">
                                        <p class="text-sm text-gray-800 whitespace-pre-wrap">{{ $msg->content }}</p>
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-1 ml-1">Admin &middot; {{ $msg->created_at->format('d M H:i') }}</p>
                                </div>
                            </div>
                        @else
                            {{-- Pesan dari user --}}
                            <div class="flex items-end gap-2 max-w-[80%] ml-auto flex-row-reverse">
                                <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <div class="text-right">
                                    <div class="bg-emerald-700 text-white rounded-2xl rounded-br-md px-4 py-2.5 shadow-sm text-left">
                                        <p class="text-sm whitespace-pre-wrap">{{ $msg->content }}</p>
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-1 mr-1">
                                        {{ $msg->created_at->format('d M H:i') }}
                                        @if($msg->is_read)
                                            <span class="text-emerald-500">&#10003;&#10003;</span>
                                        @else
                                            <span class="text-gray-400">&#10003;</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            {{-- Input pesan --}}
            <div class="px-4 py-3 bg-white border-t border-gray-200">
                @if(Auth::user()->isChatClosed())
                    <div class="text-center py-3">
                        <div class="flex items-center justify-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <p class="text-sm text-gray-500">Percakapan ini telah ditutup oleh admin.</p>
                        </div>
                        <form method="POST" action="{{ route('chat.new') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-700 text-white text-sm font-medium rounded-xl hover:bg-emerald-800 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Mulai Percakapan Baru
                            </button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('chat.store') }}" class="flex items-end gap-2">
                        @csrf
                        <textarea name="content" rows="1" required placeholder="Ketik pesan..." class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm resize-none max-h-32" oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'">{{ old('content') }}</textarea>
                        <button type="submit" class="p-2.5 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 transition shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                    @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chat = document.getElementById('chat-messages');
            chat.scrollTop = chat.scrollHeight;
        });
    </script>
</x-layouts.app>
