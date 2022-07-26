<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>    
    <title>Home</title>

</head>
<body class='container mt-3'>
    @foreach ($resorces as $resorce)
    @if ($resorce->type === 'link')
    <x-ShowLinkComponent title="{{$resorce->link->title}}" id="{{$resorce->id}}"  url="{{$resorce->link->link}}" newtabcheck='{{$resorce->link->newtabcheck}}' /> 
    @elseif ($resorce->type === 'file')
    <x-ShowFileComponent title="{{$resorce->file->title}}" id="{{$resorce->id}}"  url="{{$resorce->file->path}}" /> 
    @else
    <x-ShowSnippetComponent title="{{$resorce->snippet->title}}" id="{{$resorce->id}}" snippethtml='{{$resorce->snippet->snippet}}'  description="{{$resorce->snippet->description}}" /> 
    @endif
    @endforeach
    @if(count($resorces) ==0)
    <h4>we don't have any resource</h4>
    @endif


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>