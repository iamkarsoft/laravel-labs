<x-layout>
    <div class="container max-w-lg mx-auto bg-gray-300">
        <header class="bg-blue-600 p-4">
            <h1 class="font-bold text-white">My Site</h1>
        </header>

        <div class="grid grid-cols-12 p-4">
            <aside class="mr-6 col-span-3 text-sm">
                <ul>
                    <li>Link 1</li>
                    <li>Link 2</li>
                    <li>Link 3</li>
                </ul>
            </aside>

            <main class="text-sm col-span-9">
                <p class="mb-4">
                    Exercitation commodo velit duis reprehenderit anim duis ullamco et ut cillum officia nostrud.
                </p>
                <p class="mb-4">
                    Pariatur eu ad ad dolor esse mollit sunt esse esse.
                </p>
                <p>
                    Eiusmod laborum duis et ipsum occaecat aliquip minim nulla consequat esse nisi voluptate.
                </p>
            </main>
        </div>

        <footer class="bg-blue-600 p-4 flex items-center justify-between text-xs text-white">
            <h5 class="text-xs">My Site</h5>
            <p>2021</p>
        </footer>
    </div>

    {{-- modal --}}

     <div>
        <div class="fixed inset-0 bg-slate-100 opacity-70">

        </div>
            <div class="bg-white p-4 space-y-4 shadow-sm max-w-sm m-auto h-[240px] rounded-md fixed top right-0 inset-0">
              <div class="flex flex-col justify-between space-y-8 ">
                   <header>
                    <h2 class="text-xl font-bold">Modal Header</h2>
                   </header>

                   <main>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, ratione!
                   </main>

                   <footer class="space-x-4">
                        <button class="bg-gray-400 rounded text-xs uppercase text-white py-2 px-4 hover-gray-500 transition-all duration-200">Cancel</button>
                        <button class="bg-blue-400 rounded text-xs text-white uppercase py-2 px-4 hover-gray-500 transition-all duration-200">Continue</button>
                   </footer>
                </div>
              </div>
     </div>

</x-layout>
