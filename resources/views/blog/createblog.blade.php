<x-app-layout>
    <div class="flex items-start justify-center min-h-screen bg-blue-200 rounded-lg shadow-lg dark:bg-slate-950 ">
        @if (session('publish'))
            <div class="fixed z-20 flex items-center justify-center w-1/4 h-12 px-4 py-2 font-extrabold text-center text-green-500 rounded-lg mt-36 bg-sky-100 dark:bg-gray-700"
                id="published">
                {{ session('publish') }}
            </div>
        @endif
        <div class="w-11/12 m-auto mt-24 rounded-lg lg:w-4/5 sm:w-11/12 dark:bg-inherit p-auto">
            <form action="{{ route('blog.store') }}" method="POST" class="">
                @csrf
                {{-- <div class="flex justify-center">
                    <div class="fixed z-10 w-11/12 h-12 p-2 mt-2 mb-4 bg-opacity-50 rounded-lg backdrop-blur-sm bg-white/30 dark:bg-white/10"
                        style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                        <h2 class="p-1 text-center">Tools to style the blog </h2></div>
                </div> --}}
                <div class="flex justify-center">
                    <textarea
                        class="w-full border-t-0 border-b-0 border-l-4 border-r-0 resize-none bg-inherit border-l-indigo-500 focus:outline:none focus:ring-0 focus:border-l-indigo-500 dark:text-slate-50 lg:text-1xl sm:text-md"
                        style="" name="blogtitle" placeholder="Title" required></textarea>
                </div>
                <div class="flex justify-center">
                    <textarea
                        class="w-full p-3 mt-2 border-none rounded-lg outline-none resize-y bg-inherit focus:outline-none focus:border-none focus:ring-0 dark:text-slate-50 lg:text-1xl sm:text-md"
                        style="text-overflow:none" rows="18" name="blogcontent" placeholder="Content" required></textarea>
                </div>
                {{-- <div class="flex justify-center">
                    <input type="file" multiple id="blogfiles" name="blogfiles" class="w-full p-3 m-1 rounded-lg">
                </div> --}}
                <div class="flex justify-center m-3 lg:justify-end sm:justify-center">
                    <button type="button"
                        class="w-1/2 p-2 m-1 bg-indigo-500 rounded-lg lg:w-1/5 sm:w-1/2 dark:bg-indigo-500"><span
                            class="font-normal dark:text-slate-100 text-slate-50 text-normal">Save As
                            Draft</span></button>
                    <button type="submit"
                        class="w-1/2 p-2 m-1 bg-indigo-500 rounded-lg lg:w-1/5 sm:w-1/2 dark:bg-indigo-500"><span
                            class="dark:text-slate-100 text-slate-50 text-normal">Publish</span></button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
