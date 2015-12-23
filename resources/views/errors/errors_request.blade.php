@if($errors->any())
    <div class="content">
        <div class="alert alert-danger">
            <button class="close" data-dismiss="alert">&times;</button>
            Solicione los siguientes errores:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif