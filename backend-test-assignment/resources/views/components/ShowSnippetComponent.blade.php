<div class="row justify-content-center mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">Resourse id={{$id}} and Type=HTML Snippet File</div>
            <div class="card-body">
               Title: {{$title}} .
               <p>{{$description}}</p>
               <textarea disabled="true" id='mysnippet' style="border: none;background-color:white;">{!! $snippethtml !!}</textarea><br>
               <button onclick='copyXmpValue()' class='btn btn-outline-success'>Copy this Snippet</button>
            </div>
        </div>
     </div>
</div>
<script>
function copyXmpValue(){
    var snippet=document.getElementById("mysnippet")
    // console.log(snippet.value)
    navigator.clipboard.writeText(snippet.value);
    toastr.success('Copy to clipboard');
}
</script>