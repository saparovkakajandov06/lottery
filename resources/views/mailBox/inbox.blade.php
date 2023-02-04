@extends('layouts.empty')

@section('content')
<style>
div{
    width:50%;
    margin:auto;
    text-align:center;
}
button{
    padding:20px;
    margin:auto;
    margin-top:50px;
    width:200px;
    font-size: 24px;
    border:none;
    outline:none;
    background-color: green;
    border-radius: 10px;
    transition: all ease .4s;
}
button:hover{
    cursor: pointer;
    color:white;

}
</style>
<div>
    <button id="try">Click Me</button>
</div>
<script>
  $(function () {
    $('#try').click(function () {
            $.ajax({
                type: "GET",
                url : "/try",
                success:function(response){
                    // alert(response.message)
                    console.log(response);
                },
                error:function(err){
                    console.log(err)
                }
            })
    })
    });
</script>
@endsection
