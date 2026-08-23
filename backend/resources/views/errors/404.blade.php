@extends('layouts.app')

@section('title', 'Strona nie znaleziona (404) | MIRiOLA Dolina Skawy')
@section('meta_description', 'Ta strona nie istnieje. Wróć do głównej strony Ośrodka MIRiOLA.')
@section('robots', 'noindex, follow')

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center px-gutter py-20 text-center">

    <div class="relative mb-8">
        <span class="font-display text-[9rem] md:text-[12rem] font-black text-primary/10 leading-none select-none">404</span>
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="material-symbols-outlined text-7xl md:text-9xl text-primary/30">location_off</span>
        </div>
    </div>

    <h1 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4 leading-tight">
        Ups! Ta strona nie istnieje
    </h1>
    <p class="text-on-surface-variant text-base md:text-lg max-w-md mb-10 leading-relaxed">
        Szukana strona mogła zostać przeniesiona, usunięta lub adres URL jest nieprawidłowy.
        Wróć do strony głównej lub wybierz interesującą Cię sekcję.
    </p>

    <div class="flex flex-col sm:flex-row items-center gap-4 mb-12">
        <a href="{{ url('/') }}"
           class="bg-primary text-white font-bold px-8 py-3.5 rounded-lg hover:shadow-lg btn-animate flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined text-base">home</span>
            Strona główna
        </a>
        <a href="{{ url('/aktualnosci') }}"
           class="border border-primary text-primary font-bold px-8 py-3.5 rounded-lg hover:bg-primary hover:text-white btn-animate flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined text-base">newspaper</span>
            Aktualności
        </a>
    </div>

    {{-- Quick navigation --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl w-full">
        <a href="{{ url('/osrodek') }}"
           class="group bg-white border border-slate-200 rounded-xl p-5 hover:border-primary hover:shadow-md transition-all text-center">
            <span class="material-symbols-outlined text-3xl text-primary mb-2">hotel</span>
            <p class="font-bold text-primary text-sm">Ośrodek Wypoczynkowy</p>
            <p class="text-xs text-on-surface-variant mt-1">Noclegi i atrakcje</p>
        </a>
        <a href="{{ url('/jarmark') }}"
           class="group bg-white border border-slate-200 rounded-xl p-5 hover:border-primary hover:shadow-md transition-all text-center">
            <span class="material-symbols-outlined text-3xl text-primary mb-2">local_cafe</span>
            <p class="font-bold text-primary text-sm">Jarmark & Kawiarnia</p>
            <p class="text-xs text-on-surface-variant mt-1">Menu i atrakcje</p>
        </a>
        <a href="{{ url('/gospodarstwo') }}"
           class="group bg-white border border-slate-200 rounded-xl p-5 hover:border-primary hover:shadow-md transition-all text-center">
            <span class="material-symbols-outlined text-3xl text-primary mb-2">agriculture</span>
            <p class="font-bold text-primary text-sm">Gospodarstwo</p>
            <p class="text-xs text-on-surface-variant mt-1">Czosnek, borówki, miody</p>
        </a>
    </div>

    <p class="mt-10 text-xs text-on-surface-variant">
        Masz pytanie? Zadzwoń do nas:
        <a href="tel:+48608103119" class="text-primary font-bold hover:text-accent transition-colors">+48 608 103 119</a>
    </p>
</div>
@endsection
