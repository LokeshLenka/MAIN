<x-app-layout>
    <div class="min-h-screen bg-blue-300 dark:bg-slate-950 flex justify-center items-start">
        <div
            class=" h-full flex justify-center mt-24 bg-sky-100 dark:bg-slate-900 dark:text-slate-50 text-slate-900 w-11/12 lg:w-4/5 sm:w-11/12 rounded-lg shadow-lg">

            <div class="flex flex-col w-full">
                <div class="w-4/5 flex justify-center mx-auto rounded-lg h-32 mt-10  border-indigo-600 bg-fuchsia-400">
                    Background DP
                </div>
                <div class="w-28 flex justify-center mx-auto h-28 -mt-12 bg-fuchsia-900 rounded-full">
                    DP
                </div>
                <div class="w-4/5 flex justify-center mx-auto h-8 mt-1 bg-transparent rounded-lg">
                    <p class="text-xl text-indigo-600 font-semibold"> {{ $username->name }} </p>
                </div>
                <div
                    class="w-4/5 h-auto min-h-20 lg:max-h-32 flex justify-center mx-auto mt-1 bg-transparent rounded-lg">
                    <p>
                        {!! nl2br($userdetails->bio) !!}
                    </p>
                </div>

                <div class="w-full lg:w-4/5 flex justify-center mx-auto m-2 p-2">
                    <div class="w-full lg:w-2/3 flex justify-around mx-auto">
                        <div class="w-full border-r text-center">
                            {{ $userdetails->blogpostcount }}<br>
                            Posts

                        </div>
                        <div class="w-full text-center">
                            <span id="followers-count">{{ $userdetails->followers()->count() }}</span><br>
                            Followers
                        </div>

                        <div class="w-full border-l text-center">
                            {{ $userdetails->following }}<br>
                            Following
                        </div>
                    </div>
                </div>

                <h1><?php echo auth()->id(), '<br>';
                echo $userdetails->user_id;
                ?> </h1>

                {{-- Conditional rendering for buttons --}}
                @csrf
                @if (auth()->id() !== $userdetails->user_id)
                    <div
                        class="w-4/5 flex flex-col sm:flex-row justify-center sm:space-x-5 mx-auto mt-12 space-y-4 sm:space-y-0 mb-4">
                        <div class="w-full h-10 flex justify-end">


                            <button id="follow-btn"
                                class="min-w-32 w-full lg:w-1/2 sm:w-1/5 bg-blue-400 text-white hover:bg-blue-500 py-2 rounded-lg text-center"
                                data-user-id="{{ $userdetails->user_id }}">
                                {{ auth()->user()->isFollowing($userdetails->user_id)? 'Unfollow': 'Follow' }}
                            </button>

                        </div>
                        <div class="w-full h-10 flex justify-start sm:flex-row">
                            <button
                                class="min-w-32 w-full lg:w-1/2 sm:w-1/5 bg-blue-400 text-white hover:bg-blue-500 py-2 rounded-lg text-center">
                                Message
                            </button>
                            <button
                                class="w-auto sm:w-auto border-2 ml-4 py-2 px-1 rounded-lg flex justify-center border-black dark:border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#60A5FA">
                                    <path
                                        d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- @extends('blog.showblog') --}}
</x-app-layout>
<script>
    document.getElementById('follow-btn').addEventListener('click', async function() {
        const userId = this.getAttribute('data-user-id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const action = this.textContent.trim().toLowerCase(); // Follow or Unfollow

        try {
            const response = await fetch(`/bloguser/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    action
                })
            });

            if (response.ok) {
                const data = await response.json();
                // Toggle button text
                this.textContent = action === 'follow' ? 'Unfollow' : 'Follow';
                // Update the followers count dynamically
                document.getElementById('followers-count').textContent = data.followers;
            } else {
                console.error('Failed to update follow status:', response.statusText);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>
