{{-- @section('content') --}}
<style>
    .hideReply{
        display: none;
    }
</style>
@foreach($comments as $comment)

<div class="display-comment" @if($comment->parent_id!= null) style="margin-left:40px;"@endif >
       <strong> <img style="vertical-align: middle;width: 30px; height: 30px; border-radius: 50%; margin-right:10px; margin-top:1px;" align="left"src="/storage/profiles/{{ $comment->user->profile_pic}}"></strong>
         <strong>{{ $comment->user->firstName }}</strong>
        <strong>{{ $comment->user->lastName }}</strong>
        <p>{{ $comment->body }}
        <a class="btn btn-link reply" data-id="#{{$comment->id}}" data-target="#{{$comment->id}}">Reply</a>
        <div class="hideReply" id="{{$comment->id}}"  @if($comment->parent_id!= null) style="margin-left:40px;"@endif >
            <form method="post" action="{{ route('reply.add') }}">
                    {{ csrf_field() }}
                <div class="form-group" >
                    <input type="text" name="comment_body" class="form-control" placeholder="Write a reply..." />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply" />
                </div>
            </form>
        </div>
        @include('posts.comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach
<script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
<script>
$(".reply").unbind("click").on("click",function(){
    var id = $(this).data();
    var strID = id.id;

    console.log(strID);
    if (strID == id.id) {
        $(strID).css('display','block');
        
    }
    else{
        alert("2");
        $(id.id).removeClass();
    }
})
</script>