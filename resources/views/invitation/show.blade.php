@extends('layouts.app')

@section('title', 'Invitation Wedding Daffa & Nadia for ' . $guest->name)

@section('content')
<div id="flipbook-container" class="w-full min-h-screen flex justify-center items-center p-2 sm:p-4 md:p-5 bg-black relative overflow-hidden">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black z-50 flex items-center justify-center opacity-100 transition-opacity duration-500">
        <div class="text-center text-white">
            <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-white mx-auto mb-4"></div>
            <p class="text-lg font-semibold">Loading...</p>
            <p class="text-sm opacity-75">Preparing your invitation</p>
        </div>
    </div>

    <!-- Background Music Audio Element -->
    <audio id="background-music" loop preload="auto" style="display: none;">
        <source src="{{ asset('storage/music/01K6354M9RTNCTT8DAWZAVKYCD.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>


    <!-- Play/Pause Toggle Button -->
    <button id="music-toggle" class="fixed top-4 left-4 z-40 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full p-3 shadow-lg hover:bg-white/30 transition-all duration-300 pointer-events-auto" style="pointer-events: auto;">
        <svg id="play-icon" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
        </svg>
        <svg id="pause-icon" class="w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 20 20" style="display: none;">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
    </button>

    <div id="flipbook">
        @include('invitation.pages.cover')
        @include('invitation.pages.welcome')
        @include('invitation.pages.couple')
        @include('invitation.pages.events')
        @include('invitation.pages.gallery')
        @include('invitation.pages.amplop')
        @include('invitation.pages.thankyou')
        @include('invitation.pages.rsvp')
    </div>
</div>

@include('invitation.pages.script')
@endsection