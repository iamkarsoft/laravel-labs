<x-layout>
    <form action="{{route('trix.data')}}" method="post" class="border-gray-200">
        @csrf
        <div class="mt-4">
            <label for="">title</label>
            <input type="text" name="title" id="">
        </div>

        <div class="mt-4">
            <label for="">category</label>
            <input type="text" name="name" id="">
        </div>

        <div class="mt-4">
            <label for="">Article</label>
            <input id="x" type="hidden" name="content" value="" />
            <trix-editor input="x" class="trix-content"></trix-editor>
        </div>

        <div class="mt-4">
            <button type="submit">Post</button>
        </div>
                <script src="{{asset('js/trix.js')}}"></script>
    </form>
</x-layout>
