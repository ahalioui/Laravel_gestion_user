<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            EDIT NOTIFICATIONS
        </h2>
    </x-slot>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier la notification <strong>{{ $notification->id}}</strong></div>

                <div class="card-body">
                    <form action="{{ route('admin.notifications.update', $notification)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row mb-3">
                            <label for="type" class="col-md-6 col-form-label">{{ __('TYPE') }}</label>
                            <div class="col-md-12">
                                <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') ?? $notification->type }}" required autocomplete="type" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">   
                                <label for="data" class="col-md-6 col-form-label">{{ __('DATA') }}</label>
                            <div class="col-md-12">
                                <input id="data" type="text" class="form-control @error('data') is-invalid @enderror" name="data" value="{{ old('data') ?? $notification->data }}" required autocomplete="data" autofocus>
                            </div>
                        </div>

                        <x-button type="submit" class="btn btn-primary">Modifier les informations</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
