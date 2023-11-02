@if(session()->has('message'))
    <div id="toast-container" class="toast-container toast-top-right deleteAlert">
        <div class="toast toast-success" aria-live="polite" style="display: block;"><button type="button" class="toast-close-button" role="button">×</button>
            <div class="toast-title">Success!</div>
            <div class="toast-message" role="alert">👋 {{ session('message') }}</div>
        </div>
    </div>
@endif
@if(session()->has('errorMessage'))
    <div id="toast-container" class="toast-container toast-top-right deleteAlert">
        <div class="toast toast-error" aria-live="assertive" style="display: block;"><button type="button" class="toast-close-button" role="button">×</button>
            <div class="toast-title">Error!</div>
            <div class="toast-message">👋 {{ session('errorMessage') }}</div>
        </div>
    </div>
@endif
{{--@if(Auth::user())--}}
{{--<div id="watermark">{{\Illuminate\Support\Facades\Auth::user()->userCode}}</div>--}}
{{--@endif--}}
