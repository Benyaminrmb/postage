@if ($errors->any())
    <div class="col-md-12 d-flex flex-wrap justify-content-center align-items-center">
        <div class="alert alert-danger col-md-12" role="alert">
            <h4 class="alert-heading h5">لطفا موارد زیر را برسی کنید.</h4>
            @foreach ($errors->all() as $key=>$error)
                <p>{{$key+1}} . {{ $error }}</p>
            @endforeach

        </div>
    </div>
@endif
