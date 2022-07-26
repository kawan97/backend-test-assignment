<div class="row justify-content-center mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">Resourse id={{$id}} and Type=PDF File</div>
            <div class="card-body">
               Title: {{$title}} ,
               Download: <a href="{{asset('storage/'.$url)}}" download> Click Me</a>
            </div>
        </div>
     </div>
</div>
