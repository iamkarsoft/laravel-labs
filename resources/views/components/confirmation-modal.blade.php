<div x-data="{show: false}" x-show="show">
    <div class="fixed inset-0 bg-slate-100 opacity-70">

    </div>
        <div class="bg-white p-4 space-y-4 shadow-sm max-w-sm m-auto h-[240px] rounded-md fixed top right-0 inset-0">
          <div class="flex flex-col justify-between space-y-8 ">
               <header>
                <h2 class="text-xl font-bold">{{$title}}</h2>
               </header>

               <main>
                {{$body}}
               </main>

               <footer class="space-x-4">
               {{$footer}}

               </footer>
            </div>
          </div>
</div>
