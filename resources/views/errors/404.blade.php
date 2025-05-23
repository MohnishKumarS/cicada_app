@extends('layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="ccd--empty">
                <div class="ccd-empty__icon">
                    <img src="{{ asset('images/cicada.webp') }}" class="img-fluid ccd-empty__logo" width="100" height="100"
                        alt="cicada-logo">
                </div>
                <h3 class="ccd-empty__title page--head">Hooray! PAGE NOT FOUND</h3>
                <div class="ccd-empty__link">
                    <a href="{{ url('/') }}" class="btn-sec">Back to Home</a>
                </div>
            </div>
        </div>
    </section>
@endsection