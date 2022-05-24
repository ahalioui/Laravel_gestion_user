<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ADD NOTIFICATIONS
        </h2>
    </x-slot>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un contact de notification</div>

                <div class="card-body">
                    <form action="{{ route('admin.notifications.store') }}" method="POST" action="{{ route('admin.notifications.store') }}">
                        @csrf
                       
                        
                        <div class="row mb-3">
                            <label for="type" class="col-md-6 col-form-label">{{ __('TYPE') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" id="type" name="type">
                                <option>Email</option>
                                <option>Phone</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="row mb-3">   
                                <label for="data" class="col-md-6 col-form-label">{{ __('DATA') }}</label>
                            <div class="col-md-12">
                                <input id="data" type="text" class="form-control @error('data') is-invalid @enderror" name="data"">
                                @error('data')
                                <div>{{ $errors->first('data'); }}</div>
                                @enderror
                            </div>
                        </div>

                        <x-button type="submit" class="btn btn-primary">Ajouter</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
