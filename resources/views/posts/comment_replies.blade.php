@foreach($comments as $comment)
 
<div class="display-comment" @if($comment->parent_id!= null) style="margin-left:40px;"@endif >
       <strong> <img style="vertical-align: middle;width: 30px; height: 30px; border-radius: 50%; margin-right:10px; margin-top:1px;" align="left"src="/storage/profiles/{{ $comment->user->profile_pic}}"></strong>
         <strong>{{ $comment->user->firstName }}</strong>
        <strong>{{ $comment->user->lastName }}</strong>
        <p>{{ $comment->body }}
        <a href="" id="reply"></a>
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
        @include('posts.comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach