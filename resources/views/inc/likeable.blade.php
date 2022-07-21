@section('scripts')
    <script>
        function likePost(id){
            $.ajax({
                type: "POST",
                url: "/like-post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    postId: id,
                },
                success: function(data){
                    $("#likes"+id).text(data.likeCount);
                    if($("#btnLike"+id).css("color") == "rgb(32, 42, 68)"){
                        $("#btnLike"+id).css("color", "#7B7B7C");
                    }else{
                        $("#btnLike"+id).css("color", "#202A44");
                    }
                    //alert(data.msg);
                },
                error: function(xhr){
                    alert("Ocurrio un error : " + xhr.status + " " + xhr.statusText);
                }
            });
        }

        function sharePost(id){
            $.ajax({
                type: "POST",
                url: "/share-post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    postId: id,
                },
                success: function(data){
                    $("#shares"+id).text(data.shareCount);
                    var url = window.location.href + "/" + id;
                    var sample = document.createElement("textArea");
                    document.body.appendChild(sample);
                    sample.value = url;
                    sample.select();
                    document.execCommand("copy");
                    document.body.removeChild(sample);
                    alert("Enlace copiado");
                },
                error: function(xhr){
                    alert("Ocurrio un error : " + xhr.status + " " + xhr.statusText);
                }
            });
        }

        function followProfile(id){
            $.ajax({
                type: "POST",
                url: "/follow-profile",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    companyId: id,
                },
                success: function(data){
                    $("#followsCount").text(data.followsCount);
                    if ($("#followBtn").css("color") == "rgb(32, 42, 68)") {
                        $("#followBtn").css("color", "#761F17");
                    } else {
                        $("#followBtn").css("color", "#202A44");
                    }
                },
                error: function(xhr){
                    alert("Ocurrio un error : " + xhr.status + " " + xhr.statusText);
                }
            });
        }

        function followProfesional(id){
            $.ajax({
                type: "POST",
                url: "/follow-profesional",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    profesionalId: id,
                },
                success: function(data){
                    $("#profFollowCount").text(data.followsCount);
                    if ($("#followProBtn").css("color") == "rgb(32, 42, 68)") {
                        $("#followProBtn").css("color", "#761F17");
                    } else {
                        $("#followProBtn").css("color", "#202A44");
                    }
                    location.reload();
                },
                error: function(xhr){
                    alert("Operación realizada con exito");
                    location.reload();
                }
            });
        }

        function sendRequest(id){
            $.ajax({
                type: "POST",
                url: "/send-request",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    companyId: id,
                },
                success: function(data){
                    alert(data.msg);
                },
                error: function(xhr){
                    alert("Ocurrio un error : " + xhr.status + " " + xhr.statusText);
                }
            });
        }
    </script>
@endsection