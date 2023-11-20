<div class="shadow rounded bg-white p-5 mb-5">

    @auth()
        <p class="text-xl font-bold text-center mb-4">Comenta esta publicacion</p>
        <form wire:submit="createComment" class="flex flex-col justify-center">
            <textarea
                wire:model="comment"
                id="comment"
                name="comment"
                type="text"
                class="border p-3 w-full rounded-lg @error('comment')
                    border-red-500
                @enderror"
                required
            > </textarea>

            @error('comment')
                <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
            @enderror

            <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 uppercase font-bold mt-2 w-48 block p-3 text-white rounded-lg cursor-pointer self-end">
        </form>
    @endauth

    
    <div class="{{ ($comments->count() > 0) ? 'overflow-y-scroll max-h-96' : 'max-h-20' }}
                bg-white 
                  shadow 
                  mt-5">
        @forelse ( $comments as $comment )
            <div class="p-5 border-gray-300 border-b">
                <a class="font-bold" href="{{ route('posts.index', $comment->user) }}">{{ $comment->user->username }}</a>
                <p>{{ $comment->comentario }}</p>
                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <p class="p-10 text-center">Aun no hay comentarios</p>
        @endforelse
    </div>        
</div>

