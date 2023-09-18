@if(session()->has('message'))
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 text-white font-weight-bold rounded">--}}
{{--            <div class="alert bg-gradient-success" id="deleteAlert" role="alert">{{ session('message') }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id="toast-container" class="toast-container toast-top-right deleteAlert">
        <div class="toast toast-success" aria-live="polite" style="display: block;"><button type="button" class="toast-close-button" role="button">×</button>
            <div class="toast-title">Success!</div>
            <div class="toast-message font-medium-1" role="alert">👋 {{ session('message') }}</div>
        </div>
    </div>
@endif
@if(session()->has('errorMessage'))
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 text-white font-weight-bold rounded">--}}
{{--            <div class="alert bg-gradient-danger" id="deleteAlert" role="alert">{{ session('errorMessage') }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id="toast-container" class="toast-container toast-top-right deleteAlert">
        <div class="toast toast-error" aria-live="assertive" style="display: block;"><button type="button" class="toast-close-button" role="button">×</button>
            <div class="toast-title">Error!</div>
            <div class="toast-message font-medium-1">👋 {{ session('errorMessage') }}</div>
        </div>
    </div>
@endif
