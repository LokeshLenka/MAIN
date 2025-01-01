<x-app-layout>
    <div class="flex items-start justify-center min-h-screen bg-blue-200 rounded-lg shadow-lg dark:bg-slate-950">
        <div class="grid w-11/12 grid-cols-1 gap-10 mt-24 sm:grid-cols-2 lg:grid-cols-3 lg:w-4/5 sm:w-11/12">
            @foreach ($blogusers as $bloguser)
                @if (auth()->id() !== $bloguser->user_id)
                    <div
                        class="flex flex-col justify-center w-full p-4 bg-blue-100 rounded-lg shadow-xl min-h-80 dark:bg-slate-900">
                        <div class="flex flex-col justify-between w-full h-full">
                            <!-- Blog Title -->

                            <div>
                                <h3 class="mb-2 text-lg font-bold text-indigo-600 dark:text-indigo-300">
                                    {{ $bloguser->user_id }}
                                </h3>
                            </div>

                            <!-- Blog Content -->
                            <div class="-mt-16">
                                <p class="text-sm text-gray-700 truncate dark:text-slate-300 text-wrap">
                                    @foreach ($users as $user)
                                        @if ($bloguser->user_id == $user->id)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>

                            <!-- Action Links -->
                            <div class="flex flex-row justify-between">
                                @if (!auth()->user()->isFollowing($bloguser))
                                    <form class="w-full mx-auto flex" action="{{ route('followUser') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $bloguser->user_id }}" name="userid" />
                                        <input type="hidden" value="follow" name="action" />
                                        <button
                                            class=" w-4/5 mx-auto text-indigo-500 border-2 border-indigo-500 rounded-lg shadow-lg  hover:text-white hover:bg-indigo-500 min-h-12 m-auot p-auto transition ease-in-out duration-100 "
                                            data-user-id="{{ $bloguser->user_id }}" type="submit">Follow</button>
                                    </form>
                                @else
                                    <form class="w-full mx-auto flex" action="{{ route('followUser') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $bloguser->user_id }}" name="userid" />
                                        <input type="hidden" value="unfollow" name="action" />
                                        <button
                                            class=" w-4/5 mx-auto text-indigo-500 border-2 border-indigo-500 rounded-lg shadow-lg  hover:text-white hover:bg-indigo-500 min-h-12 m-auot p-auto transition ease-in-out duration-100 "
                                            data-user-id="{{ $bloguser->user_id }}" type="submit">Unfollow</button>
                                    </form>
                                @endif
                                </form>

                                {{-- <a href="{{ route('blog.show', $blog->id) }}"
                                class="mt-4 text-sm text-indigo-500 dark:text-indigo-400">
                                Read More..
                            </a> --}}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    // Add this to your JavaScript file
    document.querySelectorAll('.follow-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`/follow/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button state
                        this.classList.remove('follow-btn');
                        this.classList.add('unfollow-btn');
                        this.textContent = 'Unfollow';
                    }
                });
        });
    });

    document.querySelectorAll('.unfollow-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`/unfollow/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button state
                        this.classList.remove('unfollow-btn');
                        this.classList.add('follow-btn');
                        this.textContent = 'Follow';
                    }
                });
        });
    });
</script>
