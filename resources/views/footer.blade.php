<x-app-layout>

    <div class="container py-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-dark text-white py-3">

                <h4 class="mb-0">
                    Footer Settings
                </h4>

            </div>

            <div class="card-body p-4">

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif

                <form action="{{ route('settings.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Site Name
                            </label>

                            <input type="text" name="site_name" class="form-control"
                                value="{{ $setting->site_name ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input type="text" name="phone" class="form-control" value="{{ $setting->phone ?? '' }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Footer Description
                        </label>

                        <textarea name="footer_description" rows="4"
                            class="form-control">{{ $setting->footer_description ?? '' }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Facebook
                            </label>

                            <input type="text" name="facebook" class="form-control"
                                value="{{ $setting->facebook ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Twitter
                            </label>

                            <input type="text" name="twitter" class="form-control"
                                value="{{ $setting->twitter ?? '' }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Instagram
                            </label>

                            <input type="text" name="instagram" class="form-control"
                                value="{{ $setting->instagram ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Youtube
                            </label>

                            <input type="text" name="youtube" class="form-control"
                                value="{{ $setting->youtube ?? '' }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Address
                        </label>

                        <input type="text" name="address" class="form-control" value="{{ $setting->address ?? '' }}">

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Copyright
                            </label>

                            <input type="text" name="copyright" class="form-control"
                                value="{{ $setting->copyright ?? '' }}">

                        </div>

                    </div>

                    <div class="text-end">

                        <button class="btn btn-dark px-5">

                            Save Settings

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>