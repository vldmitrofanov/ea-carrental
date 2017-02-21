@extends('admin.partials.layouts.master')
@section('title')
    404 Error Page
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                404 Error Page
            </h1>
        </section>

        <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="{{ url('admin/dashboard') }}">return to dashboard</a> or try using the search form.
                    </p>
                    <p>
                        Possible Resons:
                    <ul>
                        <li>The page may have been moved or broken.</li>
                        <li>You may have used broken link.</li>
                        <li>You may have typed the address (URL) incorrectly.</li>
                    </ul>
                    </p>

                </div>
            </div>
        </section>
    </div>
@endsection