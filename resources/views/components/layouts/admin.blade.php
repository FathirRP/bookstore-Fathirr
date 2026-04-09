<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} - Admin PUJI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden bg-[#eef3ea] text-slate-900" x-data="{ sidebarMobile: false }" style="opacity:1">
    <div class="fixed inset-0 -z-20 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.95),_rgba(238,243,234,0.85)_35%,_rgba(228,236,228,0.9)_100%)]"></div>
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 left-[-8rem] h-72 w-72 rounded-full bg-emerald-300/30 blur-3xl"></div>
        <div class="absolute right-[-5rem] top-20 h-80 w-80 rounded-full bg-sky-200/40 blur-3xl"></div>
        <div class="absolute bottom-[-8rem] left-1/3 h-72 w-72 rounded-full bg-amber-200/30 blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.2]" style="background-image: linear-gradient(rgba(148, 163, 184, 0.12) 1px, transparent 1px), linear-gradient(90deg, rgba(148, 163, 184, 0.12) 1px, transparent 1px); background-size: 34px 34px;"></div>
    </div>

    {{-- Mobile overlay --}}
    <div x-show="sidebarMobile" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarMobile = false" class="fixed inset-0 bg-slate-950/45 backdrop-blur-sm z-40 lg:hidden"></div>

    <div class="relative mx-auto flex min-h-screen w-full max-w-[1680px] gap-0 px-0 lg:gap-6 lg:px-6 lg:py-6">
        {{-- Sidebar --}}
        <aside :class="sidebarMobile ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-[19.5rem] shrink-0 transform transition-transform duration-300 ease-out lg:sticky lg:top-6 lg:h-[calc(100vh-3rem)] lg:translate-x-0">
            <div class="flex h-full flex-col overflow-hidden border border-slate-900/80 bg-[linear-gradient(180deg,_rgba(8,15,25,0.98)_0%,_rgba(10,18,30,0.96)_58%,_rgba(13,23,35,0.98)_100%)] text-white shadow-[0_34px_90px_-36px_rgba(15,23,42,0.72)] lg:rounded-[32px]">
                <div class="relative overflow-hidden border-b border-white/10 px-6 pb-6 pt-6">
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-emerald-400/60 to-transparent"></div>
                    <div class="absolute right-[-2.5rem] top-[-1rem] h-24 w-24 rounded-full bg-emerald-400/15 blur-2xl"></div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/20">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold tracking-tight text-white">PUJI</h1>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-emerald-200/70">Admin Control Room</p>
                        </div>
                        <button @click="sidebarMobile = false" class="ml-auto rounded-xl p-2 text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="mt-6 rounded-[24px] border border-white/10 bg-white/[0.04] p-4 backdrop-blur-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-slate-400">Shift Hari Ini</p>
                                <p class="mt-2 text-base font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-400">Operasional toko, order masuk, dan pesan pelanggan dipantau dari satu panel.</p>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-emerald-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                Live
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4 admin-scrollbar">
            <p class="px-3 mb-2 text-[10px] font-bold tracking-widest text-slate-500 uppercase">Menu Utama</p>

            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'routeIs' => 'admin.dashboard', 'label' => 'Dasbor', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>'],
                    ['route' => 'admin.reports.index', 'routeIs' => 'admin.reports.*', 'label' => 'Laporan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3v18h18"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 14.25l3-3 2.25 2.25L17 8.25"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8.25h-3.75"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8.25V12"/>'],
                    ['route' => 'admin.categories.index', 'routeIs' => 'admin.categories.*', 'label' => 'Kategori', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6h.008v.008H6V6z"/>'],
                    ['route' => 'admin.books.index', 'routeIs' => 'admin.books.*', 'label' => 'Buku', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>'],
                    ['route' => 'admin.orders.index', 'routeIs' => 'admin.orders.*', 'label' => 'Pesanan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>'],
                ];
                $navItems2 = [
                    ['route' => 'admin.users.index', 'routeIs' => 'admin.users.*', 'label' => 'Pengguna', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
                    ['route' => 'admin.messages.index', 'routeIs' => 'admin.messages.*', 'label' => 'Pesan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>'],
                ];
            @endphp

            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs($item['routeIs']) ? 'bg-gradient-to-r from-emerald-500/16 via-emerald-400/10 to-transparent text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] ring-1 ring-emerald-400/15' : 'text-slate-400 hover:bg-white/[0.06] hover:text-white' }}">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl transition-colors duration-200 {{ request()->routeIs($item['routeIs']) ? 'bg-emerald-400/15 text-emerald-300' : 'bg-white/[0.04] text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                    </span>
                    <span class="flex-1">{{ $item['label'] }}</span>
                    @if(request()->routeIs($item['routeIs']))
                        <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_14px_rgba(110,231,183,0.8)]"></span>
                    @endif
                </a>
            @endforeach

            <p class="px-3 mt-5 mb-2 text-[10px] font-bold tracking-widest text-slate-500 uppercase">Manajemen</p>

            @foreach($navItems2 as $item)
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs($item['routeIs']) ? 'bg-gradient-to-r from-emerald-500/16 via-emerald-400/10 to-transparent text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] ring-1 ring-emerald-400/15' : 'text-slate-400 hover:bg-white/[0.06] hover:text-white' }}">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl transition-colors duration-200 {{ request()->routeIs($item['routeIs']) ? 'bg-emerald-400/15 text-emerald-300' : 'bg-white/[0.04] text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                    </span>
                    <span class="flex-1">{{ $item['label'] }}</span>
                    @if(request()->routeIs($item['routeIs']))
                        <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_14px_rgba(110,231,183,0.8)]"></span>
                    @endif
                </a>
            @endforeach
                </nav>

                {{-- User & Logout --}}
                <div class="border-t border-white/10 px-4 py-4">
                    <div class="rounded-[24px] border border-white/10 bg-white/[0.04] p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 text-sm font-bold text-white shadow-lg shadow-emerald-500/15">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="truncate text-[11px] uppercase tracking-[0.22em] text-slate-500">Administrator</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="group flex w-full items-center gap-3 rounded-2xl border border-red-400/10 bg-red-400/5 px-3 py-3 text-sm font-medium text-slate-300 transition-all duration-200 hover:border-red-400/20 hover:bg-red-400/10 hover:text-red-300">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/[0.04] text-slate-500 transition-colors group-hover:text-red-300">
                                    <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                </span>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="flex min-h-screen flex-1 flex-col lg:min-h-[calc(100vh-3rem)]">
            {{-- Top header --}}
            <header class="sticky top-0 z-30 px-4 pt-4 sm:px-6 lg:px-0 lg:pt-0">
                <div class="overflow-hidden rounded-[28px] border border-white/70 bg-white/75 shadow-[0_28px_70px_-48px_rgba(15,23,42,0.4)] backdrop-blur-xl">
                    <div class="flex flex-col gap-4 px-5 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                        <div class="flex items-start gap-4">
                            <button @click="sidebarMobile = true" class="rounded-2xl border border-slate-200 bg-white/80 p-2.5 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                            </button>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-emerald-700/80">Control Room</p>
                                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-[2rem]">{{ $header ?? 'Dasbor' }}</h1>
                                <p class="mt-1 text-sm text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2.5 sm:justify-end">
                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-2 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Admin Online
                            </span>
                            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3v18h18M7 14.25l3-3 2.25 2.25L17 8.25"/></svg>
                                Laporan
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-slate-800">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                Lihat Toko
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 px-4 pb-6 pt-4 sm:px-6 lg:px-0 lg:pb-0 lg:pt-6">
                <div class="rounded-[32px] border border-white/70 bg-white/60 p-4 shadow-[0_28px_70px_-50px_rgba(15,23,42,0.28)] backdrop-blur-sm sm:p-6 lg:min-h-[calc(100vh-11rem)] lg:p-8">
            {{-- Notifications --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200/60 text-emerald-700 px-5 py-3.5 rounded-xl animate-fade-in-down" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200/60 text-red-700 px-5 py-3.5 rounded-xl animate-fade-in-down" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
