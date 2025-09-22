@extends('layouts.app')

@section('title', "Undangan $guest->name")

@section('content')
<div id="flipbook" class="flipbook">
    <!-- Halaman Cover -->
    <div class="page">
        <h1>Undangan Pernikahan</h1>
        <p>Kepada: {{ $guest->name }}</p>
        <img src="{{ asset($wedding->cover_photo ?? 'default-cover.jpg') }}" alt="Cover">
    </div>

    <!-- Halaman Bride & Groom -->
    <div class="page">
        <h2>Bride & Groom</h2>
        <div class="flex justify-between mt-4 w-full">
            <div class="text-center">
                <img src="{{ asset($wedding->bride_photo) }}" alt="Bride">
                <p>{{ $wedding->bride_name }}</p>
                <p>( {{ $wedding->bride_nickname }} )</p>
            </div>
            <div class="text-center">
                <img src="{{ asset($wedding->groom_photo) }}" alt="Groom">
                <p>{{ $wedding->groom_name }}</p>
                <p>( {{ $wedding->groom_nickname }} )</p>
            </div>
        </div>
    </div>

    <!-- Halaman Akad & Resepsi -->
    <div class="page">
        <h2>Akad & Resepsi</h2>
        <p>Akad: {{ \Carbon\Carbon::parse($wedding->akad_date)->format('d M Y') }}, {{ $wedding->akad_start_time }} - {{ $wedding->akad_end_time }}</p>
        <p>Tempat: {{ $wedding->akad_place }}</p>
        <hr class="my-2">
        @if($guest->session == 1)
            <p>Resepsi 1: {{ \Carbon\Carbon::parse($wedding->reception1_date)->format('d M Y') }}, {{ $wedding->reception1_start_time }} - {{ $wedding->reception1_end_time }}</p>
            <p>Tempat: {{ $wedding->reception1_place }}</p>
        @else
            <p>Resepsi 2: {{ \Carbon\Carbon::parse($wedding->reception2_date)->format('d M Y') }}, {{ $wedding->reception2_start_time }} - {{ $wedding->reception2_end_time }}</p>
            <p>Tempat: {{ $wedding->reception2_place }}</p>
        @endif
    </div>

    <!-- Halaman Lokasi & RSVP -->
    <div class="page">
        <h2>Lokasi</h2>
        @if($wedding->maps_url)
            <p><a href="{{ $wedding->maps_url }}" target="_blank" class="text-blue-500 underline">Lihat di Google Maps</a></p>
        @endif
        <hr class="my-2">
        <h2>Konfirmasi Kehadiran (RSVP)</h2>
        <form action="{{ route('invitation.rsvp', ['session' => $guest->session, 'guestSlug' => $guest->slug]) }}" method="POST">
            @csrf
            <div class="mb-2">
                <label>
                    <input type="radio" name="attend" value="1" required> Hadir
                </label>
                <label class="ml-4">
                    <input type="radio" name="attend" value="0" required> Tidak Hadir
                </label>
            </div>
            <div class="mb-2">
                <label>Komentar / Pesan:</label>
                <textarea name="message" class="w-full border rounded p-2" rows="3"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const pageFlip = new St.PageFlip(document.getElementById('flipbook'), {
        width: 800,
        height: 600,
        size: "fixed",
        drawShadow: true,
        flippingTime: 700,
        showCover: true
    });

    pageFlip.loadFromHTML(document.querySelectorAll(".flipbook .page"));
});
</script>
@endpush
