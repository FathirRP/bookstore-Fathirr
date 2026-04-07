<x-layouts.admin title="Chat - {{ $user->name }}" header="Chat dengan {{ $user->name }}">
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-700 mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden flex flex-col" style="height: 72vh;">
        {{-- Chat header --}}
        <div class="px-5 py-3.5 bg-slate-50/80 border-b border-slate-200/80 flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-sm shadow-emerald-500/15">
                <span class="text-white font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-sm">{{ $user->name }}</h3>
                <p class="text-[11px] text-slate-400">{{ $user->email }}</p>
            </div>
            <div class="ml-auto flex items-center gap-2">
                @if($user->isChatClosed())
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-xl ring-1 ring-inset ring-red-500/10">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        Chat Ditutup
                    </span>
                @else
                    <form method="POST" action="{{ route('admin.messages.close', $user) }}" onsubmit="return confirm('Yakin ingin menutup percakapan ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-xl hover:bg-red-700 transition-colors shadow-sm shadow-red-500/15">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                            Tutup Chat
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-4 bg-gradient-to-b from-slate-50/50 to-white admin-scrollbar" id="chat-messages">
            @if($messages->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-slate-300">
                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                    <p class="text-sm font-medium">Belum ada pesan</p>
                </div>
            @else
                @foreach($messages as $msg)
                    @if(!$msg->is_admin)
                        {{-- User message --}}
                        <div class="flex items-end gap-2.5 max-w-[80%]">
                            <div class="w-7 h-7 rounded-lg bg-slate-200 flex items-center justify-center shrink-0">
                                <span class="text-slate-500 font-bold text-[10px]">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <div class="bg-white border border-slate-200/80 rounded-2xl rounded-bl-lg px-4 py-2.5 shadow-sm">
                                    <p class="text-sm text-slate-700 whitespace-pre-wrap">{{ $msg->content }}</p>
                                </div>
                                <p class="text-[10px] text-slate-300 mt-1 ml-1 font-medium">{{ $msg->created_at->format('d M H:i') }}</p>
                            </div>
                        </div>
                    @else
                        {{-- Admin message --}}
                        <div class="flex items-end gap-2.5 max-w-[80%] ml-auto flex-row-reverse">
                            <div class="w-7 h-7 rounded-lg bg-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z"/></svg>
                            </div>
                            <div class="text-right">
                                <div class="bg-emerald-600 text-white rounded-2xl rounded-br-lg px-4 py-2.5 shadow-sm shadow-emerald-500/10 text-left">
                                    <p class="text-sm whitespace-pre-wrap">{{ $msg->content }}</p>
                                </div>
                                <p class="text-[10px] text-slate-300 mt-1 mr-1 font-medium">
                                    {{ $msg->created_at->format('d M H:i') }}
                                    @if($msg->is_read)
                                        <span class="text-emerald-400">&#10003;&#10003;</span>
                                    @else
                                        <span class="text-slate-300">&#10003;</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        {{-- Reply input --}}
        <div class="px-5 py-3.5 bg-white border-t border-slate-200/80">
            @if($user->isChatClosed())
                <div class="text-center py-2">
                    <p class="text-sm text-slate-400 font-medium">Percakapan ini telah ditutup.</p>
                </div>
            @else
                <form method="POST" action="{{ route('admin.messages.reply', $user) }}" class="flex items-end gap-3">
                    @csrf
                    <textarea name="content" rows="1" required placeholder="Ketik balasan..." class="flex-1 px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm resize-none max-h-32 transition placeholder:text-slate-300" oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'"></textarea>
                    <button type="submit" class="p-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors shrink-0 shadow-sm shadow-emerald-500/15">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chat = document.getElementById('chat-messages');
            chat.scrollTop = chat.scrollHeight;
        });
    </script>
</x-layouts.admin>
