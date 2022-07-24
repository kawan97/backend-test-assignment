<div class="row justify-content-center mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning">Resourse id={{$id}} and Type=Link</div>
            <div class="card-body">
               Title: {{$title}} ,
               Link : <a href="{{$url}}"  {{$newtabcheck=='true' ? 'target=_blank' : '' }}> Click Me</a>
            </div>
        </div>
     </div>
</div>
