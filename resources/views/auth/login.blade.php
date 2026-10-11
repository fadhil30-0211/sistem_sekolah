@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 my-12">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-navy">Masuk Sistem</h2>
        <p class="text-sm text-gray-500">Portal & Sistem Informasi SMAN Okura</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 text-sm rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-gray-300 focus:border-emerald focus:ring-emerald">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <input type="password" name="password" required class="w-full rounded-lg border-gray-300 focus:border-emerald focus:ring-emerald">
        </div>
        <button type="submit" class="w-full bg-emerald text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition">
            Masuk Dashboard
        </button>
    </form>
</div>
@endsection
