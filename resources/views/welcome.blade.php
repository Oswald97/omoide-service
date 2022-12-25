@push('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
<x-app-layout>
    <div class="container app-form">
        <div>
            <div class="app-form-header">
                <img src="{{ asset('images/logo.PNG') }}" alt="Omoide Logo">
                <h4 style="text-align: center">Omoïde: Service de réception</h4>
            </div>
            <form action="{{ route('save') }}" method="post" class="billing-form" novalidate enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success_message'))
                    <div class="alert alert-success" role="alert">
                        {{session('success_message')}}
                    </div>
                @endif

                <div class="mb-3">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Votre Nom </label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: GANDONOU" aria-label="Votre Nom ">
                            <div data-form-error="name" class="invalid-feedback">
                                Veuillez entrer votre nom.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="surname" class="form-label">Votre Prénom </label>
                            <input type="text" name="surname" class="form-control" placeholder="Ex: Luc" aria-label="Votre Prénom ">
                            <div data-form-error="surname" class="invalid-feedback">
                                Veuillez entrer votre prénom.
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="username" class="form-label">Votre Nom d’utilisateur Instagram ou Facebook </label>
                            <input type="text" name="username" class="form-control" placeholder="luc@1234" aria-label="Nom d’utilisateur">
                            <div data-form-error="username" class="invalid-feedback">
                                Veuillez entrer votre nom d'utilisateur Instagram ou Facebook.
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Votre pays </label>
                            <input type="text" id="country" name="country" class="form-control" placeholder="Pays" aria-label="Pays">
                            <div data-form-error="country" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="display: block">Votre Numéro de téléphone </label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Ex: 66562625" aria-label="Numéro de téléphone">
                            <input type="number" name="dialCode" hidden >
                            <div data-form-error="phone" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="address" class="form-label">Votre adresse </label>
                            <textarea name="address" id="address" cols="30" rows="2" class="form-control" placeholder="Médina Rue 22"></textarea>
                            <div data-form-error="address" class="invalid-feedback">
                                Veuillez entrer votre adresse.
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                <label>Charger des fichiers
                                    <span class="custom-file-container__image-clear" title="Retirer toutes les images">Tout supprimer</span>
                                </label>
                                <label class="custom-file-container__custom-file">
                                    <input
                                        type="file"
                                        class="custom-file-container__custom-file__custom-file-input"
                                        multiple
                                        name="formFile[]"
                                        aria-label="Choisissez vos photos"
                                        accept="image/*"
                                    />
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span
                                        class="custom-file-container__custom-file__custom-file-control"
                                    ></span>
                                </label>
                                <span data-form-error="formFile" class="invalid-feedback">
                                    Veuillez choisir vos photos.
                            </span>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-form-action">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
